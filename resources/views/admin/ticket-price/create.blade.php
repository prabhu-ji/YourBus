@extends('admin.layouts.app')
@section('title','Add Ticket Price')
@section('content')
<div class="content-wrapper">
@component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'/dashboard','Ticket Price'=>'admin/ticket-price']])
    @slot('title') Add Ticket Price @endslot
    @slot('add_btn')  @endslot
    @slot('active') Add Ticket Price @endslot
@endcomponent
<div class="main-content">
<section class="content card">
    <div class="container-fluid card-body">
        <form class="form-horizontal" id="add_ticket" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" class="url" value="{{url('admin/ticket-price')}}" >
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ticket Price Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Fleet Type</label>
                                        <select name="fleet_type" class="form-control">
                                            <option value="">Select an option</option>
                                            @foreach($fleet as $item)
                                                @if($item->status == '1')
                                                    <option value="{{$item->id}}">{{$item->fleet_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Route</label>
                                        <select name="route" class="form-control">
                                            <option value="">Select an option</option>
                                            @foreach($route as $item)
                                                @if($item->status == '1')
                                                    <option value="{{$item->id}}">{{$item->route_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ticket Price ({{$siteInfo->cur_format}})</label>
                                        <input type="number" name="ticket_price" class="form-control" placeholder="Ticket Price">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</section>
</div>
<footer class="main-footer">
<strong>Copyright <?php echo date('Y'); ?> <a href="https://github.com/prabhu-ji">Prabhu Ji</a>.</strong>
    All rights reserved
  </footer> 
</div>
@stop