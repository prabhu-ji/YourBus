<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fleet;
use App\Models\Route;
use App\Models\Ticket;
use Yajra\DataTables\DataTables;

class TicketController extends Controller
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
            $data = Ticket::select('tickets.*','fleet.fleet_name as fleet_name','routes.route_name as route_name')
                    ->leftjoin('fleet','tickets.fleet_type','=','fleet.id')
                    ->leftjoin('routes','tickets.route','=','routes.id')
                    ->orderBy('id','desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="ticket-price/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a> 
                            <a href="javascript:void(0)" class="delete-ticket btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.ticket-price.index');
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
        $route = Route::where('status','1')->get();
        return view('admin.ticket-price.create',['fleet'=>$fleet,'route'=>$route]);
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
            'fleet_type'=>'required',
            'route'=>'required',
            'ticket_price'=>'required'
        ]);

        $ticket = new Ticket();
        $ticket->fleet_type = $request->input('fleet_type');
        $ticket->route = $request->input('route');
        $ticket->ticket_price = $request->input('ticket_price');
        $result = $ticket->save();
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
        $ticket = Ticket::where(['id'=>$id])->first();
        $fleet = Fleet::where('status','1')->get();
        $route = Route::where('status','1')->get();
        return view('admin.ticket-price.edit',['ticket'=>$ticket,'fleet'=>$fleet,'route'=>$route]);
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
            'fleet_type'=>'required',
            'route'=>'required',
            'ticket_price'=>'required'
        ]);

        $ticket = Ticket::where(['id'=>$id])->update([
            'fleet_type'=>$request->input('fleet_type'),
            'route'=>$request->input('route'),
            'ticket_price'=>$request->input('ticket_price')
        ]);
        return $ticket;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $destroy = Ticket::where('id',$id)->delete();
        return $destroy;
    }
}
