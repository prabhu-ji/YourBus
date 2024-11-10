@extends('admin.layouts.app')
@section('title','Edit Facility')
@section('content')
<div class="content-wrapper">
@component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'/dashboard','Facilities'=>'admin/facility']])
    @slot('title') Edit Facility @endslot
    @slot('add_btn')  @endslot
    @slot('active') Edit Facility @endslot
@endcomponent
<div class="main-content">
<section class="content card">
    <div class="container-fluid card-body">
        <form class="form-horizontal" id="update_facility" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            @if($facility)
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" class="url" value="{{url('admin/facility/'.$facility->id)}}" >
                    <input type="hidden" class="rdt-url" value="{{url('admin/facility')}}" >
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Facility Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Facility Name</label>
                                        <input type="text" name="facility_name" class="form-control" placeholder="Facility Name" value="{{$facility->facility_name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Icon</label>
                                        <div class="input-group">
                                            <input type="text" name="icon" class="form-control" id="icon" value="{{$facility->icon}}">
                                            <span class="input-group-append">
                                                <button class="btn btn-outline-secondary" id="target" data-icon="{{$facility->icon}}" role="iconpicker"></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{$facility->status == '1' ? "selected":""}}>Active</option>
                                            <option value="0" {{$facility->status == '0' ? "selected":""}}>Inactive</option>
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
<footer class="main-footer">
<strong>Copyright <?php echo date('Y'); ?> <a href="https://github.com/prabhu-ji">Prabhu Ji</a>.</strong>
    All rights reserved
  </footer> 
</div>
@stop