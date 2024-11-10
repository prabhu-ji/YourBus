<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="site-url" content="{{ url('/') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/sweetalert-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome-free/css/all.min.css')}}">
        <style> :root{ --main-color: {{$siteInfo->theme_color}}; } </style>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script>
</head>
<body>
    <div id="header" class="py-3">
        <div class="container-xl container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-menu">
                        <nav class="navbar navbar-expand-lg navbar-light p-0">
                            <div class="logo">
                                @if($siteInfo->site_logo == '')
                                    <a href="{{url('/')}}"><h4 class="m-0">Bus Reservation</h4></a>
                                @else
                                    <a href="{{url('/')}}"><img src="{{asset('site-images/'.$siteInfo->site_logo)}}" alt="site logo" width="200px"></a>
                                @endif
                            </div>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                                <ul class="navbar-nav">
                                    <li class="nav-item mr-lg-3 {{(Request::path() == '/')? 'active':''}}">
                                        <a class="nav-link" href="{{url('/')}}"> Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item {{(Request::path() == 'contact')? 'active':''}}">
                                        <a class="nav-link" href="{{url('/contact')}}">Contact Us</a>
                                    </li>
                                    <div class="register-btn mx-3">
                                        @if(Session::has('user_name'))
                                            <ul class="navbar-nav ml-auto">
                                                <div class="dropdown">
                                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Hello, {{session()->get('user_name')}}
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{url('/my-profile')}}">My Profile</a>
                                                        <a class="dropdown-item" href="{{url('/my-bookings')}}">My Booking</a>
                                                        <a class="dropdown-item" href="{{url('/changepassword')}}">Change Password</a>
                                                        <a class="dropdown-item logout user-logout" href="javascript:void(0)">Log Out</a>
                                                    </div>
                                                </div>
                                            </ul>
                                        @else
                                            <a href="{{url('/userlogin')}}" class="btn1 btn">Login</a>
                                            <a href="{{url('/signup')}}" class="btn1 btn">Sign Up</a>
                                        @endif
                                    </div>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
