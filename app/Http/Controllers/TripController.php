<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fleet;
use App\Models\Route;
use App\Models\Location;
use App\Models\Trip;
use App\Models\Booking;
use App\Models\Vehicle;
use Yajra\DataTables\DataTables;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->ajax()){
            $data = Trip::select('trips.*','vehicles.name as vehicle_name','routes.route_name')
                    ->leftJoin('vehicles','vehicles.id','=','trips.vehicle')
                    ->leftJoin('routes','routes.id','=','trips.route')
                    ->orderBy('id','desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function($row){
                    if($row->status == '1'){
                        $status = '<span class="badge badge-success">Active</span>';
                    }else{
                        $status = '<span class="badge badge-danger">Inactive</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="trip/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a> 
                            <a href="javascript:void(0)" class="delete-trip btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('admin.trip.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $vehicles = Vehicle::select(['vehicles.*','fleet.fleet_name'])
        ->leftJoin('fleet','fleet.id','=','vehicles.fleet_type')
        ->where('vehicles.status','1')->get();
        $route = Route::where('status','1')->get();
        $location = Location::where('status','1')->get();
        return view('admin.trip.create',['vehicles'=>$vehicles,'route'=>$route,'location'=>$location]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title'=>'required|unique:trips,title',
            'vehicle'=>'required',
            'route'=>'required',
            'start_time'=>'required',
            'status'=>'required',
        ]);

        $day_off = '';
        if($request->day_off != ''){
            $day_off = implode(',',$request->input('day_off'));
        }

        $trip = new Trip();
        $trip->title = $request->input('title');
        $trip->vehicle = $request->input('vehicle');
        $trip->route = $request->input('route');
        $trip->start_time = $request->input('start_time');
        $trip->day_off = $day_off;
        $trip->status = $request->input('status');
        $result = $trip->save();
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $trip = Trip::where(['id'=>$id])->first();
        $vehicles = Vehicle::select(['vehicles.*','fleet.fleet_name'])
        ->leftJoin('fleet','fleet.id','=','vehicles.fleet_type')
        ->where('vehicles.status','1')->get();
        $route = Route::where('status','1')->get();
        $location = Location::where('status','1')->get();
        return view('admin.trip.edit',['trip'=>$trip,'vehicles'=>$vehicles,'route'=>$route,'location'=>$location]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'title'=>'required|unique:trips,title,'.$id.',id',
            'vehicle'=>'required',
            'route'=>'required',
            'start_time'=>'required',
            'status'=>'required',
        ]);

        $day_off = '';
        if($request->day_off != ''){
            $day_off = implode(',',$request->input('day_off'));
        }

        $trip = Trip::where(['id'=>$id])->update([
            'title'=>$request->input('title'),
            'vehicle'=>$request->input('vehicle'),
            'route'=>$request->input('route'),
            'start_time'=>$request->input('start_time'),
            'day_off'=>$day_off,
            'status'=>$request->input('status')
        ]);
        return $trip;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $date = date('Y-m-d');
        $check = Assigned::where('trip_name',$id)->count();
        $check1 = Booking::where('trip_id',$id)->where('journey_date','>',$date)->count();
        if($check == 0 && $check1 == 0){
            $destroy = Trip::where('id',$id)->delete();
            return $destroy;
        }else{
            return "You won't delete this (This Trip used in Assigned Vehicles List OR Booking List)";
        }
        
    }
}
