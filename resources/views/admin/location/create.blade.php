@extends('admin.layouts.app')
@section('title','Add Location')
@section('content')
<div class="content-wrapper">
    @component('admin.layouts.content-header', ['breadcrumb' => ['Dashboard' => '/dashboard', 'Location' => 'admin/location']])
        @slot('title') Add Location @endslot
        @slot('add_btn')  @endslot
        @slot('active') Add Location @endslot
    @endcomponent

    <div class="main-content">
        <section class="content card">
            <div class="container-fluid card-body">
                <!-- Set action attribute to the store route -->
                <form class="form-horizontal" id="add_location" action="{{ route('location.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" class="url" value="{{ url('admin/location') }}">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Location Details</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="name" class="form-control" placeholder="Location Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control" required>
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
