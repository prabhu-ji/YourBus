@extends('admin.layouts.app')
@section('title','Add New Vehicle')
@section('content')
<div class="content-wrapper">
@component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'/dashboard','Vehicle'=>'admin/vehicle']])
    @slot('title') Add Vehicle @endslot
    @slot('add_btn')  @endslot
    @slot('active') Add Vehicle @endslot
@endcomponent
<div class="main-content">
<section class="content card">
    <div class="container-fluid card-body">
        <form class="form-horizontal" id="add_vehicle" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Vehicle Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Fleet Type</label>
                                        <select name="fleet_type" class="form-control">
                                            <option value="">Select Fleet Type</option>
                                            @foreach($fleets as $fleet)
                                                <option value="{{$fleet->id}}">{{$fleet->fleet_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Register No.</label>
                                        <input type="text" name="register_no" class="form-control" placeholder="Register No.">
                                    </div>
                                    <div class="form-group">
                                        <label>Engine No.</label>
                                        <input type="text" name="engine_no" class="form-control" placeholder="Engine No.">
                                    </div>
                                    <div class="form-group">
                                        <label>Model No.</label>
                                        <input type="text" name="model_no" class="form-control" placeholder="Model No.">
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