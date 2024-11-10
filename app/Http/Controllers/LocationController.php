<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Route;
use Yajra\DataTables\DataTables;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Location::latest()->orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == '1') {
                        $status = '<span class="badge badge-success">Active</span>';
                    } else {
                        $status = '<span class="badge badge-danger">Inactive</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="location/' . $row->id . '/edit" class="btn btn-success btn-sm">Edit</a> 
                            <a href="javascript:void(0)" class="delete-location btn btn-danger btn-sm" data-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.location.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Custom validation with error message
        $request->validate([
            'name' => 'required|unique:locations,location_name',
            'status' => 'required',
        ], [
            'name.unique' => 'This location is already taken. Please choose a different name.',
            'name.required' => 'Location name is required.',
            'status.required' => 'Status is required.',
        ]);

        $location = new Location();
        $location->location_name = $request->input('name');
        $location->status = $request->input('status');
        $location->save();

        // Redirect or return response
        return redirect()->route('admin.location.index')->with('success', 'Location created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = Location::findOrFail($id);
        return view('admin.location.edit', ['location' => $location]);
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
        // Custom validation for update, ignoring the current record
        $request->validate([
            'name' => 'required|unique:locations,location_name,' . $id . ',id', // Ignore the current location
            'status' => 'required',
        ], [
            'name.unique' => 'This location name is already taken. Please choose a different one.',
            'name.required' => 'Location name is required.',
            'status.required' => 'Status is required.',
        ]);

        $location = Location::findOrFail($id);
        $location->location_name = $request->input('name');
        $location->status = $request->input('status');
        $location->save();

        // Redirect or return response
        return redirect()->route('admin.location.index')->with('success', 'Location updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = Route::where('start_point', $id)
            ->orWhere('end_point', $id)
            ->orWhereRaw("FIND_IN_SET(" . $id . ", more_stoppage)")->count();

        if ($check == 0) {
            Location::destroy($id);
            return redirect()->route('admin.location.index')->with('success', 'Location deleted successfully!');
        } else {
            return redirect()->route('admin.location.index')->with('error', "You can't delete this location because it's used in routes.");
        }
    }
}
