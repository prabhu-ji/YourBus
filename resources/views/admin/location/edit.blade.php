@extends('admin.layouts.app')
@section('title','Edit Location')
@section('content')
<div class="content-wrapper">
@component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'/dashboard','Location'=>'admin/location']])
    @slot('title') Edit Location @endslot
    @slot('add_btn')  @endslot
    @slot('active') Edit Location @endslot
@endcomponent
<div class="main-content">
<section class="content card">
    <div class="container-fluid card-body">
        <form class="form-horizontal" id="update_location" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            @if($location)
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" class="url" value="{{url('admin/location/'.$location->id)}}" >
                    <input type="hidden" class="rdt-url" value="{{url('admin/location')}}" >
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Fleet Type Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Location Name" value="{{$location->location_name}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{$location->status == '1' ? "selected":""}}>Active</option>
                                            <option value="0" {{$location->status == '0' ? "selected":""}}>Inactive</option>
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
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</section>
</div> 
</div>
@stop