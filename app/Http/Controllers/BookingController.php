<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use Yajra\DataTables\DataTables;

class BookingController extends Controller
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
            $data = Booking::select(['booking.*','trips.title as trip_name','users.name as user_name'])
                    ->leftjoin('trips','booking.trip_id','=','trips.id')
                    ->leftjoin('users','users.user_id','=','booking.user_id')
                    ->orderBy('id','desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function($row){
                    if($row->payment_status == '1'){
                        $status = '<span class="badge badge-success">Completed</span>';
                    }else{
                        $status = '<span class="badge badge-danger">Not Completed</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="booking/'.$row->id.'/view" class="btn btn-success btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('admin.booking.index');
    }


    public function Bookingview($id){
        $message = Booking::select(['booking.*','trips.title as trip_name','users.name as user_name','users.email as user_email','users.phone as user_phone'])
                    ->leftjoin('trips','booking.trip_id','=','trips.id')
                    ->leftjoin('users','users.user_id','=','booking.user_id')
                    ->where(['booking.id'=>$id])->first();
        $general = DB::table('general_settings')->first();
        return view('admin.booking.view',['message'=>$message,'general'=>$general]);
    }
}
