<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Route;
use App\Models\Ticket;
use App\Models\Trip;
use Yajra\DataTables\DataTables;

class RouteController extends Controller
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
            $data = Route::select('routes.*','locations.location_name as start_name','e.location_name as end_name')
                    ->leftjoin('locations','routes.start_point','=','locations.id')
                    ->leftjoin('locations as e','routes.end_point','=','e.id')
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
                    $btn = '<a href="route/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a> 
                            <a href="javascript:void(0)" class="delete-route btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('admin.route.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $location = Location::all();
        return view('admin.route.create',['location'=>$location]);
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
            'name'=>'required|unique:routes,route_name',
            'start_from'=>'required',
            'end_to'=>'required',
            'total_time'=>'required',
            'total_distance'=>'required',
            'status'=>'required'
        ]);

        $route = new Route();
        $route->route_name = $request->input('name');
        $route->start_point = $request->input('start_from');
        $route->end_point = $request->input('end_to');
        if($request->stoppage != ''){
            $route->more_stoppage = implode(',',$request->input('stoppage'));
        }
        $route->total_distance = $request->input('total_distance');
        $route->total_time = $request->input('total_time');
        $route->status = $request->input('status');
        $result = $route->save();
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
        $route = Route::where(['id'=>$id])->first();
        $location = Location::all();
        return view('admin.route.edit',['route'=>$route,'location'=>$location]);
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
            'name'=>'required|unique:routes,route_name,'.$id.',id',
            'start_from'=>'required',
            'end_to'=>'required',
            'total_time'=>'required',
            'total_distance'=>'required',
            'status'=>'required'
        ]);
        $stoppage = '';
        if($request->stoppage != ''){
            $stoppage = implode(',',$request->input('stoppage'));
        }

        $route = Route::where(['id'=>$id])->update([
            'route_name'=>$request->input('name'),
            'start_point'=>$request->input('start_from'),
            'end_point'=>$request->input('end_to'),
            'more_stoppage'=>$stoppage,
            'total_distance'=>$request->input('total_distance'),
            'total_time'=>$request->input('total_time'),
            'status'=>$request->input('status')
        ]);
        return $route;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = Ticket::where('route',$id)->count();
        $check1 = Trip::where('route',$id)->count();
        if($check == 0 && $check1 == 0){
            $destroy = Route::where('id',$id)->delete();
            return $destroy;
        }else{
            return "You won't delete this (This Route is used in Trip List OR Ticket Price list)";
        }
        
    }
}
