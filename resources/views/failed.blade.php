@extends('layout')
@section('title',session()->get('error'))
@section('content')

<div class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                  <h2 class="m-0">{{session()->get('error')}}</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{session()->get('error')}}</li>
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
                    <i class="fas fa-times-circle"></i>
                </div>
                <h4>{{session()->get('error')}}!</h4>
            </div>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-12">
            <div class="booking-btn text-center">
                <a href="{{url('/')}}" class="btn1 btn text-center">Try Again</a>
            </div>
        </div>
    </div>
</div>

@stop