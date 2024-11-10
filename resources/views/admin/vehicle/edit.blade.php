@extends('admin.layouts.app')
@section('title','Edit Vehicle')
@section('content')
<div class="content-wrapper">
@component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'/dashboard','Vehicle'=>'admin/vehicle']])
    @slot('title') Edit Vehicle @endslot
    @slot('add_btn')  @endslot
    @slot('active') Edit Vehicle @endslot
@endcomponent
<div class="main-content">
<section class="content card">
    <div class="container-fluid card-body">
        <form class="form-horizontal" id="update_vehicle" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            @if($vehicle)
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" class="url" value="{{url('admin/vehicle/'.$vehicle->id)}}" >
                    <input type="hidden" class="rdt-url" value="{{url('admin/vehicle')}}" >
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Vehicle Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{$vehicle->name}}">
                                        <input type="text" hidden name="id" value="{{$vehicle->id}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Fleet Type</label>
                                        <select name="fleet_type" class="form-control">
                                            @if(!empty($fleets))
                                                @foreach($fleets as $fleet)
                                                    @if($vehicle->fleet_type == $fleet->id)
                                                        <option value="{{$fleet->id}}" selected>{{$fleet->fleet_name}}</option>
                                                    @else
                                                        @if($fleet->status == '1')
                                                            <option value="{{$fleet->id}}">{{$fleet->fleet_name}}</option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Register No.</label>
                                        <input type="text" name="register_no" class="form-control" placeholder="Register No." value="{{$vehicle->register_no}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Engine No.</label>
                                        <input type="text" name="engine_no" class="form-control" placeholder="Engine No." value="{{$vehicle->engine_no}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Model No.</label>
                                        <input type="text" name="model_no" class="form-control" placeholder="Model No." value="{{$vehicle->model_no}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{$vehicle->status == '1' ? "selected":""}}>Active</option>
                                            <option value="0" {{$vehicle->status == '0' ? "selected":""}}>Inactive</option>
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