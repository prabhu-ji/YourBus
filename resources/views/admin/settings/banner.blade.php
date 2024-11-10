@extends('admin.layouts.app')
@section('title','Edit Banner')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
@component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Banner Settings @endslot
    @slot('add_btn')  @endslot
    @slot('active') Banner Settings @endslot
@endcomponent
<!-- Main content -->
<section class="content card">
    <div class="container-fluid card-body">
        <!-- form start -->
        <form class="form-horizontal" id="update_banner"  method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @foreach($data as $item)
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Banner Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Title" value="{{$item->title}}">
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2">Image</label>
                                <div class="custom-file col-md-7">
                                    <input type="hidden" class="custom-file-input" name="old_img" value="{{$item->banner_img}}" />
                                    <input type="file" class="custom-file-input" name="img" onChange="readURL(this);">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                                <div class="col-md-3 text-right">
                                    @if($item->banner_img != '')
                                    <img id="image" src="{{asset('public/banner/'.$item->banner_img)}}" alt="" width="200px" height="150px">
                                    @else
                                    <img id="image" src="{{asset('public/banner/banner.jpg')}}" alt="" width="80px" height="80px">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            @endforeach
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form> <!-- /.form start -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->
</div>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
</script>
@stop