@extends('admin.layouts.app')
@section('title','Edit Trip')
@section('content')
<div class="content-wrapper">
@component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'/dashboard','Trips'=>'admin/trip']])
    @slot('title') Edit Trip @endslot
    @slot('add_btn')  @endslot
    @slot('active') Edit Trip @endslot
@endcomponent
<div class="main-content">
<section class="content card">
    <div class="container-fluid card-body">
        <form class="form-horizontal" id="update_trip" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            @if($trip)
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" class="url" value="{{url('admin/trip/'.$trip->id)}}" >
                    <input type="hidden" class="rdt-url" value="{{url('admin/trip')}}" >
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Trip Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Title</label>
                                        <input type="text" name="title" class="form-control" placeholder="Title" value="{{$trip->title}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Route</label>
                                        <select name="route" class="form-control">
                                            @if(!empty($route))
                                                @foreach($route as $item)
                                                    @if($trip->route == $item->id)
                                                        <option value="{{$item->id}}" selected>{{$item->route_name}}</option>
                                                    @else
                                                        @if($item->status == '1')
                                                            <option value="{{$item->id}}">{{$item->route_name}}</option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Start Time</label>
                                        <input type="text" name="start_time" id="timepicker" class="form-control" placeholder="Start Time" value="{{$trip->start_time}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Day Off</label>
                                        <select class="form-control select2" name="day_off[]" multiple="multiple">
                                            @php
                                                $row_facility = array_filter(explode(',',$trip->day_off));
                                            @endphp
                                            <option value="sunday" {{in_array("sunday",$row_facility) == 'sunday' ? "selected":""}}>Sunday</option>
                                            <option value="monday" {{in_array("monday",$row_facility) == 'sunday' ? "selected":""}}>Monday</option>
                                            <option value="tuesday" {{in_array("tuesday",$row_facility) == 'sunday' ? "selected":""}}>Tuesday</option>
                                            <option value="wednesday" {{in_array("wednesday",$row_facility) == 'sunday' ? "selected":""}}>Wednesday</option>
                                            <option value="thrusday" {{in_array("thrusday",$row_facility) == 'sunday' ? "selected":""}}>Thrusday</option>
                                            <option value="friday" {{in_array("friday",$row_facility) == 'sunday' ? "selected":""}}>Friday</option>
                                            <option value="saturday" {{in_array("saturday",$row_facility) == 'sunday' ? "selected":""}}>Saturday</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Assign Vehicle</label>
                                        <select name="vehicle" class="form-control">
                                            @if(!empty($vehicles))
                                                @foreach($vehicles as $item)
                                                    @if($trip->vehicle == $item->id)
                                                        <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{$trip->status == '1' ? "selected":""}}>Active</option>
                                            <option value="0" {{$trip->status == '0' ? "selected":""}}>Inactive</option>
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