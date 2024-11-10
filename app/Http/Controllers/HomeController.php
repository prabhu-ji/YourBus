<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Contact;
use App\Models\Users;
use App\Models\Trip;
use App\Models\Location;
use App\Models\Fleet;
use App\Models\Route;
use App\Models\Booking;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    // Display the home page
    public function index()
    {
        $banner = DB::table('banner')->get();
        $facility = Facility::all();
        $social = DB::table('social_links')->get();
        $location = Location::where('status', 1)->get();
        
        return view('index', [
            'banner' => $banner, 
            'facility' => $facility, 
            'social' => $social, 
            'location' => $location
        ]);
    }

    // Display the contact page
    public function contact()
    {
        $general_settings = DB::table('general_settings')->get();
        $social = DB::table('social_links')->get();
        
        return view('contact', [
            'general_settings' => $general_settings, 
            'social' => $social
        ]);
    }

    // Handle the contact form submission
    public function contact_form(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        Contact::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => htmlspecialchars($request->input('message'))
        ]);

        return response()->json(['status' => '1']);
    }

    // Show all bus bookings
    public function all_busbooking(Request $request)
{
    // Fetch pickup and dropping point locations
    $pickup_point = Location::find($request->pickup_point);
    $dropping_point = Location::find($request->dropping_point);

    // Check if pickup and dropping points are valid
    if (!$pickup_point) {
        return response()->json(['error' => 'Invalid pickup point'], 400);
    }

    if (!$dropping_point) {
        return response()->json(['error' => 'Invalid dropping point'], 400);
    }

    // Check if route exists
    $route_detail = Route::where('start_point', $pickup_point->id)
                         ->where('end_point', $dropping_point->id)
                         ->first();

    if (!$route_detail) {
        return response()->json(['error' => 'Route not found'], 404);
    }

    // Query routes with conditions
    $routes = Route::where(function ($query) use ($pickup_point, $dropping_point) {
        $query->where('start_point', $pickup_point->id)
              ->where('end_point', $dropping_point->id)
              ->orWhereRaw('FIND_IN_SET(?, more_stoppage)', [$pickup_point->id])
              ->orWhereRaw('FIND_IN_SET(?, more_stoppage)', [$dropping_point->id]);
    })->pluck('id');

    // Additional logic for vehicle type filter
    $where = 'trips.status = 1';
    
    if ($request->type && $request->type != 'all') {
        $type_id = Fleet::where('fleet_slug', $request->type)->value('id');
        $where .= ' AND vehicles.fleet_type = "' . $type_id . '"';
    }

    // Get the current time and the selected day
    $day_name = strtolower(date('l', strtotime($request->departure_date)));
    $time = date('h:i A');

    // Fetch trips
    $trip = Trip::select([
            'trips.*', 'trips.id as trip_id', 'routes.*', 'fleet.fleet_name',
            'locations.location_name as start_from', 'l.location_name as end_to',
            'vehicles.name as vehicle_name', 'vehicles.fleet_type',
            \DB::raw("GROUP_CONCAT(facilities.facility_name ORDER BY fleet.id) as facility_name"),
            \DB::raw("GROUP_CONCAT(facilities.icon ORDER BY fleet.id) as facility_icon")
        ])
        ->leftJoin('routes', 'routes.id', '=', 'trips.route')
        ->leftJoin('locations', 'locations.id', '=', 'routes.start_point')
        ->leftJoin('locations as l', 'l.id', '=', 'routes.end_point')
        ->leftJoin('vehicles', 'vehicles.id', '=', 'trips.vehicle')
        ->leftJoin('fleet', 'fleet.id', '=', 'vehicles.fleet_type')
        ->leftJoin('facilities', \DB::raw("FIND_IN_SET(facilities.id, fleet.facilities)"), ">", \DB::raw("'0'"))
        ->whereIn('trips.route', $routes)
        ->whereRaw($where)
        ->where('trips.start_time', '>', $time)
        ->whereNot('trips.day_off', $day_name)
        ->groupBy('trips.id')
        ->get();

    // Fetch fleet and location details
    $fleet = Fleet::latest()->where('status', 1)->get();
    $location = Location::latest()->where('status', 1)->get();
    
    return view('busbooking', [
        'pickup_point' => $pickup_point,
        'dropping_point' => $dropping_point,
        'request' => $request,
        'trip' => $trip,
        'fleet' => $fleet,
        'route_detail' => $route_detail,
        'location' => $location
    ]);
}


    // Handle ticket booking
    public function ticketbooking(Request $request, $id)
    {
        if (session()->has('user_name')) {
            // Fetch locations
            $pickup_point = Location::find($request->pickup_point);
            $dropping_point = Location::find($request->dropping_point);
            $location = Location::where('status', 1)->get();

            // Get ticket price
            $ticket_price = Ticket::whereHas('route', function ($query) use ($request) {
                $query->where('start_point', $request->pickup_point)
                      ->where('end_point', $request->dropping_point);
            })->where('fleet_type', $request->type)->value('ticket_price');
            
            // Fetch trip details
            $trip = Trip::with(['vehicle', 'fleet', 'facilities', 'seatLayout'])
                ->where('id', $id)
                ->first();

            // Fetch booked seats
            $booking = Booking::where('trip_id', $id)
                ->where('journey_date', $request->departure_date)
                ->pluck('seats');
            
            return view('ticketbooking', [
                'pickup_point' => $pickup_point,
                'dropping_point' => $dropping_point,
                'request' => $request,
                'booking' => $booking,
                'location' => $location,
                'trip' => $trip,
                'ticket_price' => $ticket_price
            ]);
        } else {
            return redirect('/userlogin');
        }
    }

    // Confirm ticket booking
    public function confirm_ticket(Request $request)
    {
        $pickup_point = Location::find($request->pickup_point);
        $dropping_point = Location::find($request->dropping_point);
        $location = Location::where('status', 1)->get();

        // Get ticket price
        $ticket_price = Ticket::whereHas('route', function ($query) use ($request) {
            $query->where('start_point', $request->pickup_point)
                  ->where('end_point', $request->dropping_point);
        })->where('fleet_type', $request->type)->value('ticket_price');

        // Fetch trip details
        $trip = Trip::with(['vehicle', 'fleet', 'facilities', 'seatLayout'])
            ->where('id', $request->id)
            ->first();
        
        // Fetch user details
        $user = Users::find(session()->get('user_id'));
        
        return view('confirm-ticket', [
            'pickup_point' => $pickup_point,
            'dropping_point' => $dropping_point,
            'request' => $request,
            'user' => $user,
            'location' => $location,
            'trip' => $trip,
            'ticket_price' => $ticket_price
        ]);
    }
}
