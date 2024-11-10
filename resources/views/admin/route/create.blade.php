@extends('admin.layouts.app')
@section('title','Add Route')
@section('content')
<div class="content-wrapper">
@component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'/dashboard','Routes'=>'admin/route']])
    @slot('title') Add Route @endslot
    @slot('add_btn')  @endslot
    @slot('active') Add Route @endslot
@endcomponent
<div class="main-content">
<section class="content card">
    <div class="container-fluid card-body">
        <form class="form-horizontal" id="add_route" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" class="url" value="{{url('admin/route')}}" >
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Route Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Route Name">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Start From</label>
                                                <select name="start_from" class="form-control">
                                                    <option value="">Select an option</option>
                                                    @foreach($location as $item)
                                                        @if($item->status == '1')
                                                            <option value="{{$item->id}}">{{$item->location_name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>End To</label>
                                                <select name="end_to" class="form-control">
                                                    <option value="">Select an option</option>
                                                    @foreach($location as $item)
                                                        @if($item->status == '1')
                                                            <option value="{{$item->id}}">{{$item->location_name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="checkbox" id="myCheck" onclick="myFunction()">
                                                <label for="myCheck">Has More Stoppage</label>
                                                <div id="stoppage" style="display:none;">
                                                    <select class="form-control select2" name="stoppage[]" multiple="multiple" style="width:100%;">
                                                        <option value="" disabled>Select an option</option>
                                                        @foreach($location as $item)
                                                            @if($item->status == '1')
                                                                <option value="{{$item->id}}">{{$item->location_name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <small>Make sure that you are adding stoppages serially followed by the starting point</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Time In Hours (Enter Hours Digits)</label>
                                        <input type="number" name="total_time" class="form-control" placeholder="Approximate Time">
                                    </div>
                                    <div class="form-group">
                                        <label>Distance in KM (Enter Kilometer digits)</label>
                                        <input type="number" name="total_distance" class="form-control" placeholder="Distance">
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