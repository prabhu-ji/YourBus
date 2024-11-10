@extends('admin.layouts.app')
@section('title','Add Trip')
@section('content')
<div class="content-wrapper">
@component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'/dashboard','Trips'=>'admin/trip']])
    @slot('title') Add Trip @endslot
    @slot('add_btn')  @endslot
    @slot('active') Add Trip @endslot
@endcomponent
<div class="main-content">
<section class="content card">
    <div class="container-fluid card-body">
        <form class="form-horizontal" id="add_trip" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" class="url" value="{{url('admin/trip')}}" >
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Trip Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Title</label>
                                        <input type="text" name="title" class="form-control" placeholder="Title">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Route</label>
                                        <select name="route" class="form-control select2">
                                            <option value="">Select an option</option>
                                            @foreach($route as $item)
                                                @if($item->status == '1')
                                                    <option value="{{$item->id}}">{{$item->route_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Start Time</label>
                                        <input type="text" name="start_time" id="timepicker" class="form-control" placeholder="Start Time">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Day Off</label>
                                        <select class="form-control select2" name="day_off[]" multiple="multiple">
                                            <option value="" disabled>Select an Option</option>
                                            <option value="sunday">Sunday</option>
                                            <option value="monday">Monday</option>
                                            <option value="tuesday">Tuesday</option>
                                            <option value="wednesday">Wednesday</option>
                                            <option value="thrusday">Thrusday</option>
                                            <option value="friday">Friday</option>
                                            <option value="saturday">Saturday</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Assign Vehicle</label>
                                        <select name="vehicle" class="form-control">
                                            <option value="" selected disabled>Select Vehicle</option>
                                            @foreach($vehicles as $vehicle)
                                                <option value="{{$vehicle->id}}"><b>{{$vehicle->fleet_name}}</b> - {{$vehicle->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</section>
</div>
</div>
@stop