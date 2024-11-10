@extends('admin.layouts.app')
@section('title','Booking Information')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
@component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Booking'=>'admin/booking']])
    @slot('title') Booking Information @endslot
    @slot('add_btn')  @endslot
    @slot('active') Booking Information @endslot
@endcomponent
<!-- Main content -->
<section class="content card">
    <div class="container-fluid card-body">
        <div class="card-header bg-primary">
            <h4 class="mb-0">Book Information</h4>
        </div>
        <ul class="message-list" style="width:100%; border-top:0px;">
        @if($message)
            <div class="row">
                <div class="col-md-6">
                    <li>
                        <span class="d-inline-block mr-3"><b>Trip Name: </b></span>
                        <p class="mb-0 d-inline-block">{{$message->trip_name}}</p>
                    </li>
                    <li>
                        <span class="d-inline-block mr-3"><b>Pickup Point: </b></span>
                        <p class="mb-0 d-inline-block">{{$message->pickup_point}}</p>
                    </li>
                    <li>
                        <span class="d-inline-block mr-3"><b>Dropping Point: </b></span>
                        <p class="mb-0 d-inline-block">{{$message->dropping_point}}</p>
                    </li>
                    <li>
                        <span class="d-inline-block mr-3"><b>Selected Seats: </b></span>
                        <p class="mb-0 d-inline-block">{{$message->seats}}</p>
                    </li>
                    <li>
                        <span class="d-inline-block mr-3"><b>Total Amount: </b></span>
                        <p class="mb-0 d-inline-block">{{$general->cur_format}} {{$message->total_amount}}</p>
                    </li>
                    <li>
                        <span class="d-inline-block mr-3"><b>Payment Status: </b></span>
                        <p class="mb-0 d-inline-block">
                            @if($message->payment_status == '1')
                                <span class="badge badge-success">Paid</span>
                            @else
                            <span class="badge badge-danger">Not Paid</span>
                            @endif
                        </p>
                    </li>
                </div>
                <div class="col-md-6">
                    <li>
                        <span class="d-inline-block mr-3"><b>Full Name: </b></span>
                        <p class="mb-0 d-inline-block">{{$message->user_name}}</p>
                    </li>
                    <li>
                        <span class="d-inline-block mr-3"><b>Email: </b></span>
                        <p class="mb-0 d-inline-block">{{$message->user_email}}</p>
                    </li>
                    <li>
                        <span class="d-inline-block mr-3"><b>Phone: </b></span>
                        <p class="mb-0 d-inline-block">{{$message->user_phone}}</p>
                    </li>
                </div>
            </div>
            @endif
        </ul>
    </div><!-- /.container-fluid -->
</section><!-- /.content -->
</div>
@stop