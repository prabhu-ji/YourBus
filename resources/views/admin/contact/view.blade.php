@extends('admin.layouts.app')
@section('title','Contact Message')
@section('content')
<div class="content-wrapper">
    @component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Contact Message'=>'admin/contact']])
        @slot('title') Contact Message @endslot
        @slot('add_btn')  @endslot
        @slot('active') Contact Message @endslot
    @endcomponent
<!-- Main content -->
<section class="content card">
    <div class="container-fluid card-body">
        <div class="card-header bg-primary" style="width:50%;">
            <h4 class="mb-0">Contact Message</h4>
        </div>
        <ul class="message-list" style="border-top:0px;">
        @if($message)
            <li>
                <span class="d-inline-block mr-3"><b>Name: </b></span>
                <p class="mb-0">{{$message->name}}</p>
            </li>
            <li>
                <span class="d-inline-block mr-3"><b>Email: </b></span>
                <p class="mb-0">{{$message->email}}</p>
            </li>
            <li>
                <span class="d-inline-block mr-3"><b>Message: </b></span>
                <p class="mb-0">{!!htmlspecialchars_decode($message->message)!!}</p>
            </li>
            @endif
        </ul>
    </div><!-- /.container-fluid -->
</section><!-- /.content -->
</div>
@stop