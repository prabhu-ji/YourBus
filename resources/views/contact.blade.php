@extends('layout')
@section('title','Contact')
@section('content')
<!------ Page Head Section ------>
<div class="page-heading">
    <div class="container-xl container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                  <h2 class="m-0">Contact Us</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!------/Page Head Section ------>

<!------ Contact Details ------>
<div class="contact-details py-5">
    <div class="container-lg container-fluid">
        <h2 class="section-heading">Our Contact</h2>
        <div class="row">
            @foreach($general_settings as $setting)
            <div class="col-md-4 col-sm-6">
                <div class="contact-info">
                    <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                    <h5 class="title">Our Address</h5>
                    <span>{{$setting->address}}</span>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="contact-info">
                    <span class="icon"><i class="fas fa-envelope"></i></span>
                    <h5 class="title">Email Us</h5>
                    <span>{{$setting->email}}</span>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="contact-info">
                    <span class="icon"><i class="fas fa-phone-alt"></i></span>
                    <h5 class="title">Call Us</h5>
                    <span>{{$setting->phone}}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!------/Contact Details ------>

<!------ Contact Form ------>
<div class="contact-form py-5">
    <div class="container-xl container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h4 class="title">Have Any Questions?</h4>
                <form class="form-horizontal" id="message" method="POST">
                    <div class="message"></div>
                    @csrf
                    <input type="hidden" class="url" value="{{url('/contact')}}" >
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="">Message</label>
                        <textarea class="form-control" placeholder="Message" name="message" id="" cols="30" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn1 btn">Send Message</button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="location-map h-100">
                    <iframe src="https://maps.google.com/maps?q={{$siteInfo->latitude}},{{$siteInfo->longitude}}&z=18&output=embed" class="map-iframe" width="100%" height="100%" style="border:0px;border-radius:20px;" class="h-100"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!------/Contact Form ------>
@stop