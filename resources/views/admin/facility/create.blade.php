@extends('admin.layouts.app')
@section('title','Add Facility')
@section('content')
<div class="content-wrapper">
@component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'/dashboard','Facilities'=>'admin/facility']])
    @slot('title') Add Facility @endslot
    @slot('add_btn')  @endslot
    @slot('active') Add Facility @endslot
@endcomponent
<div class="main-content">
<section class="content card">
    <div class="container-fluid card-body">
        <form class="form-horizontal" id="add_facility" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" class="url" value="{{url('admin/facility')}}" >
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Facility Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Facility Name</label>
                                        <input type="text" name="facility_name" class="form-control" placeholder="Facility Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Icon</label>
                                        <div class="input-group">
                                            <input type="text" name="icon" class="form-control" id="icon" value="">
                                            <span class="input-group-append">
                                                <button class="btn btn-outline-secondary" id="target" data-icon="fas fa-home" role="iconpicker"></button>
                                            </span>
                                        </div>
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
<footer class="main-footer">
    <strong>Copyright <?php echo date('Y'); ?> <a href="https://github.com/prabhu-ji">Prabhu Ji</a>.</strong>
    All rights reserved
  </footer> 
</div>
@stop