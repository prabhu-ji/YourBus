@extends('admin.layouts.app')
@section('title','General Settings')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
        @slot('title') General Settings @endslot
        @slot('add_btn') @endslot
        @slot('active') General Settings @endslot
    @endcomponent
    <section class="content">
        <div class="container-fluid">
            <form class="form-horizontal" id="updateGeneralSetting" method="POST">
            {{ csrf_field() }}
                @foreach($data as $item)
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="d-block bg-primary p-2 mb-3" style="border-radius:5px;">General Information</span>
                                        <div class="form-group">
                                            <label>Site Logo</label>
                                            <input type="hidden" class="custom-file-input" name="old_logo" value="{{$item->site_logo}}" />
                                            <input type="file" name="logo" class="form-control" onChange="readURL(this);">
                                            @if(empty($item->site_logo))
                                                <img class="img-thumbnail mt-4" id="image" src="{{asset('public/site-images/no-image.jpg')}}"  width="150px" height="150px" alt="">
                                            @else
                                                <img class="img-thumbnail mt-4" id="image" src="{{asset('public/site-images/'.$item->site_logo)}}" alt="" width="150px" height="150px">
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Site Name</label>
                                            <input type="text" class="form-control" name="site_name" value="{{$item->site_name}}"  placeholder="Enter Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Site Title</label>
                                            <input type="text" class="form-control" name="site_title" value="{{$item->site_title}}"  placeholder="Enter Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Footer Description</label>
                                            <textarea class="form-control" name="footer_desc" cols="30" rows="3">{{$item->footer_desc}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Tax</label>
                                            <input type="number" class="form-control" name="tax" value="{{$item->tax}}"  placeholder="Enter Tax">
                                        </div>
                                        <div class="form-group">
                                            <label>Currency Format</label>
                                            <input type="text" class="form-control" name="cur_format" value="{{$item->cur_format}}"  placeholder="Enter Currency Format">
                                        </div>
                                        <div class="form-group">
                                            <label>Theme Color</label>
                                            <input type="color" class="form-control" name="theme_color" value="{{$item->theme_color}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Latitude</label>
                                            <input type="text" class="form-control" name="latitude" value="{{$item->latitude}}"  placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Longitude</label>
                                            <input type="text" class="form-control" name="longitude" value="{{$item->longitude}}"  placeholder="">
                                        </div>
                                        <span class="d-block bg-primary p-2 mb-3" style="border-radius:5px;">Contact Details</span>
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="number" class="form-control" name="phone" value="{{$item->phone}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" value="{{$item->email}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address" value="{{$item->address}}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </form>
        </div>
    </section>
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
@endsection