<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fleet;
use App\Models\Vehicle;
use App\Models\Trip;
use Yajra\DataTables\DataTables;

class VehicleController extends Controller
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
            $data = Vehicle::select('vehicles.*','fleet.fleet_name as fleet_name')->leftjoin('fleet','vehicles.fleet_type','=','fleet.id')
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
                    $btn = '<a href="vehicle/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a> 
                            <a href="javascript:void(0)" class="delete-vehicle btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('admin.vehicle.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $fleet = Fleet::where('status','1')->get();
        return view('admin.vehicle.create',['fleets'=>$fleet]);
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
            'name'=>'required|unique:vehicles,name',
            'fleet_type'=>'required',
            'register_no'=>'required',
            'engine_no'=>'required',
            'model_no'=>'required',
            'status'=>'required',
        ]);

        $vehicle = new Vehicle();
        $vehicle->name = $request->input('name');
        $vehicle->fleet_type = $request->input('fleet_type');
        $vehicle->register_no = $request->input('register_no');
        $vehicle->engine_no = $request->input('engine_no');
        $vehicle->model_no = $request->input('model_no');
        $vehicle->status = $request->input('status');
        $result = $vehicle->save();
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
        $vehicle = Vehicle::where(['id'=>$id])->first();
        $fleet = Fleet::where('status','1')->get();
        return view('admin.vehicle.edit',['vehicle'=>$vehicle,'fleets'=>$fleet]);
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
            'name'=>'required|unique:vehicles,name,'.$id.',id',
            'fleet_type'=>'required',
            'register_no'=>'required',
            'engine_no'=>'required',
            'model_no'=>'required',
            'status'=>'required',
        ]);

        $vehicles = Vehicle::where(['id'=>$id])->update([
            'name'=>$request->input('name'),
            'fleet_type'=>$request->input('fleet_type'),
            'register_no'=>$request->input('register_no'),
            'engine_no'=>$request->input('engine_no'),
            'model_no'=>$request->input('model_no'),
            'status'=>$request->input('status'),
        ]);
        return $vehicles;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = Trip::where('vehicle',$id)->count();
        if($check == 0){
            $destroy = Vehicle::where('id',$id)->delete();
            return $destroy;
        }else{
            return "You won't delete this (Thsi vehicle is used in Trips List)";
        }
        
    }
}
