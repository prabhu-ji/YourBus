<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Fleet;
use Yajra\DataTables\DataTables;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Facility::latest()->orderBy('id','desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('icon', function($row){
                    if($row->icon != ''){
                        $icon = '<span><i class="'.$row->icon.'"></i></span>';
                    }else{
                        $icon = '<span><i class=""></i></span>';
                    }
                    return $icon;
                })
                ->editColumn('status', function($row){
                    if($row->status == '1'){
                        $status = '<span class="badge badge-success">Active</span>';
                    }else{
                        $status = '<span class="badge badge-danger">Inactive</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="facility/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a> 
                            <a href="javascript:void(0)" class="delete-facility btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['icon','status','action'])
                ->make(true);
        }
        $facility = Facility::all(); // Fetch all facilities to pass to the view
        return view('admin.facility.index', compact('facility'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.facility.create');
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
            'facility_name'=>'required|unique:facilities,facility_name',
            'icon'=>'required',
            'status'=>'required'
        ]);

        $facility = new Facility();
        $facility->facility_name = $request->input('facility_name');
        $facility->icon = $request->input('icon');
        $facility->status = $request->input('status');
        $facility->save();
        
        return redirect()->route('facility.index'); // Redirect back to facility list
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $facility = Facility::findOrFail($id); // Fetch the facility by ID
        return view('admin.facility.edit', compact('facility'));
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
            'facility_name'=>'required|unique:facilities,facility_name,'.$id.',id',
            'icon'=>'required',
            'status'=>'required'
        ]);

        $facility = Facility::findOrFail($id);
        $facility->facility_name = $request->input('facility_name');
        $facility->icon = $request->input('icon');
        $facility->status = $request->input('status');
        $facility->save();

        return redirect()->route('facility.index'); // Redirect back to facility list
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = Fleet::whereRaw("FIND_IN_SET(".$id.",facilities)")->count();
        if($check == 0){
            Facility::where('id', $id)->delete();
            return response()->json(['success' => 'Facility deleted successfully']);
        } else {
            return response()->json(['error' => "You can't delete this facility as it's used in fleet types."]);
        }
    }
}
