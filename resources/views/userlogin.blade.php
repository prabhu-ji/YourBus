@extends('layout')
@section('title','User Login')
@section('content')
<!------ Page Head Section ------>
<div class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                  <h2 class="m-0">User Login</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User Login</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!------/Page Head Section ------>
<div id="main-content" class="py-5">
    <div class="container-xl continer-fluid">
        <div class="row">
            <div class="offset-lg-4 col-lg-4 offset-md-3 col-md-6 offset-sm-2 col-sm-8">
                <div class="signup-form">
                    <div class="message"></div>
                    <h3 class="user-heading">Welcome Back</h3>
                    <!-- Form Start -->
                    <form class="form-horizontal" id="user_login" method ="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="username" class="form-control" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <input type="submit"  name="save" class="btn1 btn" value="Login" required />
                    </form>
                    <!-- Form End-->
                </div>
            </div>
        </div>
    </div>
</div>
@stop