<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat;
use App\Models\Facility;
use App\Models\Fleet;
use App\Models\Vehicle;
use App\Models\Ticket;
use Yajra\DataTables\DataTables;

class FleetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if($request->ajax()){
            $data = Fleet::select('fleet.*','seatlayout.layout_name as layout_name')->leftjoin('seatlayout','fleet.seat_layout','=','seatlayout.id')
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
                    $btn = '<a href="fleettype/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a> 
                            <a href="javascript:void(0)" class="delete-fleet btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('admin.fleettype.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $seat = Seat::all();
        $facility = Facility::all();
        return view('admin.fleettype.create',['seats'=>$seat,'facility'=>$facility]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:fleet,fleet_name',
            'seat_layout'=>'required',
            'total_seats'=>'required',
        ]); 

        $fleet = new Fleet();
        $fleet->fleet_name = $request->input('name');
        $fleet->fleet_slug = strtolower(str_replace(array(' ','_'),'-',$request->input('name')));
        $fleet->seat_layout = $request->input('seat_layout');
        $fleet->total_seats = $request->input('total_seats');
        if($request->facilities){
            $fleet->facilities = implode(',',$request->input('facilities'));
        }
        $fleet->status = $request->input('status');
        $result = $fleet->save();
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
        $fleet = Fleet::where(['id'=>$id])->first();
        $seat = Seat::all();
        $facility = Facility::all();
        return view('admin.fleettype.edit',['fleet'=>$fleet,'seats'=>$seat,'facility'=>$facility]);
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
        $request->validate([
            'name'=>'required|unique:fleet,fleet_name,'.$id.',id',
            'seat_layout'=>'required',
            'total_seats'=>'required',
        ]); 

        $facilities = null;
        if($request->facilities){
            $facilities = implode(',',$request->input('facilities'));
        }

        $fleets = Fleet::where(['id'=>$id])->update([
            'fleet_name'=>$request->input('name'),
            'fleet_slug'=>$request->input('fleet_slug'),
            'seat_layout'=>$request->input('seat_layout'),
            'total_seats'=>$request->input('total_seats'),
            'facilities'=>$facilities,
            'status'=>$request->input('status'),
        ]);
        return $fleets;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = Vehicle::where('fleet_type',$id)->count();
        $check1 = Ticket::where('fleet_type',$id)->count();
        if($check == 0 && $check1 == 0){
            $destroy = Fleet::where('id',$id)->delete();
            return $destroy;
        }else{
            return "You won't delete this (This Fleet type used in Vehicles OR Ticket Price List)";
        }
    }
}
