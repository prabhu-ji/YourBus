@extends('layout')
@section('title','Payment Successfull')
@section('content')

<div class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                  <h2 class="m-0">Payment Successfull</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Payment Successfull</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="successfull-page">
    <div class="row m-0">
        <div class="offset-md-4 col-md-4">
            <div class="success-message">
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h4>Payment Successfull!</h4>
            </div>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-12">
            <div class="booking-btn text-center">
                <a href="{{url('/my-bookings')}}" class="btn1 btn text-center">My Bookings</a>
            </div>
        </div>
    </div>
</div>

@stop