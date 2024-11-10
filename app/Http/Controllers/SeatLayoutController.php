<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat;
use App\Models\Fleet;
use Yajra\DataTables\DataTables;

class SeatLayoutController extends Controller
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
            $data = Seat::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="edit-seat btn btn-success btn-sm" data-id="'.$row->id.'">Edit</a> 
                            <a href="javascript:void(0)" class="delete-seat btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.seatlayout.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'layout1'=>'required',
            'layout2'=>'required',
        ]);

        $seat = new Seat();
        $seat->layout_name = $request->input('layout1').'X'.$request->input('layout1');
        $result = $seat->save();
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
        $seat = Seat::where(['id'=>$id])->first();
        return $seat;
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
            'layout1'=>'required',
            'layout2'=>'required',
        ]);

        $seat = Seat::where(['id'=>$id])->update([
            'layout_name'=>$request->input('layout1').'X'.$request->input('layout2'),
        ]);
        return $seat;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = Fleet::where('seat_layout',$id)->count();
        if($check == 0){
            $destroy = Seat::where('id',$id)->delete();
            return $destroy;
        }else{
            return "You won't Delete this (This Seat Layout May be used in Fleet Types.)";
        }
        
    }
}
