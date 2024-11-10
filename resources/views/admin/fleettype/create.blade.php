@extends('admin.layouts.app')
@section('title','Add New Fleet')
@section('content')
<div class="content-wrapper">
@component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'/dashboard','Fleet Type'=>'admin/fleettype']])
    @slot('title') Add Fleet Type @endslot
    @slot('add_btn')  @endslot
    @slot('active') Add Fleet Type @endslot
@endcomponent
<div class="main-content">
<section class="content card">
    <div class="container-fluid card-body">
        <form class="form-horizontal" id="add_fleet" method="POST" enctype="multipart/form-data">
            @csrf
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
                                        <input type="text" name="name" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Seat Layout</label>
                                        <select name="seat_layout" class="form-control">
                                            <option value="">Select Seat Layout</option>
                                            @foreach($seats as $seat)
                                                <option value="{{$seat->id}}">{{$seat->layout_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Total Seats</label>
                                        <input type="number" name="total_seats" class="form-control" placeholder="Total Number Seats">
                                    </div>
                                    <div class="form-group">
                                        <label>Facilities</label>
                                        <select class="form-control select2" name="facilities[]" multiple="multiple" style="width:100%;">
                                            <option value="" disabled>Select Facilities</option>
                                            @foreach($facility as $item)
                                                <option value="{{$item->id}}">{{$item->facility_name}}</option>
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