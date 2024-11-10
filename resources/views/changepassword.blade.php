@extends('layout')
@section('title','Change Password')
@section('content')
<!------ Page Head Section ------>
<div class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                  <h2 class="m-0">Change Password</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
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
                    <h3 class="user-heading">Change Password</h3>
                    <!-- Form Start -->
                    <form class="form-horizontal" id="changepassword" method="POST" autocomplete="off">
                        @csrf
                        <!-- <input type="hidden" class="url" value="{{url('/changepassword')}}" > -->
                        <div class="form-group">
                            <label>Old Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Old Password">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="new_pass" id="password" class="form-control"placeholder="New Password">
                        </div>
                        <div class="form-group">
                            <label>Re-enter New Password</label>
                            <input type="password" name="re_pass" class="form-control" placeholder="Re-enter New Password">
                        </div>
                        <input type="submit"  name="save" class="btn1 btn" value="Update" >
                    </form>
                    <!-- Form End-->
                </div>
            </div>
        </div>
    </div>
</div>
@stop