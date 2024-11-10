@extends('layout')
@section('title','Sign Up')
@section('content')
<!------ Page Head Section ------>
<div class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                  <h2 class="m-0">Sign Up</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!------/Page Head Section ------>
<div id="user-content" class="py-5">
    <div class="container">
        <div class="row">
              <div class="offset-md-3 col-md-6">
                <div class="signup-form">
                    <div class="message"></div>
                    <h3 class="user-heading">Sign Up</h3>
                    <!-- Form Start -->
                    <form class="form-horizontal" id="signup_form" method="POST">
                        @csrf
                        <!-- <input type="hidden" class="url" value="{{url('/signup')}}" > -->
                        <!-- <input type="hidden" class="url-login" value="{{url('/userlogin')}}" > -->
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="number" name="phone" class="form-control" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Phone">
                        </div>
                        <div class="form-group">
                            <input type="text" name="city" class="form-control" placeholder="City">
                        </div>
                        <div class="form-group">
                            <input type="text" name="state" class="form-control" placeholder="State">
                        </div>
                        <div class="form-group">
                            <input type="number" name="code" class="form-control" placeholder="Pin Code">
                        </div>
                        <div class="form-group">
                            <input type="text" name="country" class="form-control" placeholder="Country">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <input type="submit"  name="save" class="btn1 btn" value="Signup" required />
                    </form>
                    <!-- Form End-->
                </div>
                
            </div>
        </div>
    </div>
</div>
@stop