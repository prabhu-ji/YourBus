@extends('admin.layouts.app')
@section('title','Edit Fleet')
@section('content')
<div class="content-wrapper">
@component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'/dashboard','Fleet Type'=>'admin/fleettype']])
    @slot('title') Edit Fleet Type @endslot
    @slot('add_btn')  @endslot
    @slot('active') Edit Fleet Type @endslot
@endcomponent
<div class="main-content">
<section class="content card">
    <div class="container-fluid card-body">
        <form class="form-horizontal" id="update_fleet" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            @if($fleet)
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Fleet Type Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{$fleet->fleet_name}}">
                                        <input type="text" hidden name="id" value="{{$fleet->id}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Fleet Slug</label>
                                        <input type="text" name="fleet_slug" class="form-control" placeholder="Fleet Slug" value="{{$fleet->fleet_slug}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Seat Layout</label>
                                        <select name="seat_layout" class="form-control">
                                            @if(!empty($seats))
                                                @foreach($seats as $item)
                                                    @if($fleet->seat_layout == $item->id)
                                                        <option value="{{$item->id}}" selected>{{$item->layout_name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->layout_name}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Total Seats</label>
                                        <input type="number" name="total_seats" class="form-control" placeholder="Total Number Seats" value="{{$fleet->total_seats}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Facilities</label>
                                        <select class="form-control select2" name="facilities[]" multiple="multiple" style="width:100%;">
                                            <option value="" disabled>Select Facilities</option>
                                            @if(!empty($facility))
                                                @php
                                                    $row_facility = array_filter(explode(',',$fleet->facilities));
                                                @endphp
                                                @foreach($facility as $item)
                                                    @if(in_array($item->id,$row_facility))
                                                        <option value="{{$item->id}}" selected>{{$item->facility_name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->facility_name}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{$fleet->status == '1' ? "selected":""}}>Active</option>
                                            <option value="0" {{$fleet->status == '0' ? "selected":""}}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</section>
</div>
</div>
@stop