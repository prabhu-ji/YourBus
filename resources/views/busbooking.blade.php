@extends('layout')
@section('title','Bus Booking')
@section('content')
<!------ Page Head Section ------>
<div class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                  <h2 class="m-0">Bus Booking</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Bus Booking</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!------ /Page Head Section ------>

<!------ BOOKING-INFORMATION ------>
<div class="bus-information">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <form action="{{url('/all-busbooking')}}">
                    <div class="ticket-filter">
                        <div class="filter-header">
                            <h4 class="title">Filter</h4>
                        </div>
                        <div class="filter-item">
                            <label for=""><b>Departure Date</b></label>
                            <input type="date" class="form-control" name="departure_date" value="{{$request->departure_date}}" onChange="form.submit()">
                        </div>
                        <div class="filter-item">
                            <label for=""><b>Pickup Point</b></label>
                            <select name="pickup_point" id="" class="form-control" onChange="form.submit()">
                                <option value="">Select Pickup Point</option>
                                @foreach($location as $item)
                                    @if(!empty($request->pickup_point) && $request->pickup_point == $item->id)
                                        <option value="{{$item->id}}" selected>{{$item->location_name}}</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->location_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="filter-item">
                            <label for=""><b>Dropping Point</b></label>
                            <select name="dropping_point" id="" class="form-control" onChange="form.submit()">
                                <option value="">Select Dropping Point</option>
                                @foreach($location as $item)
                                    @if(!empty($request->dropping_point) && $request->dropping_point == $item->id)
                                        <option value="{{$item->id}}" selected>{{$item->location_name}}</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->location_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="filter-item">
                            <h5 class="title">Vehicle Type</h5>
                            <ul class="bus-type">
                                <li>
                                    <input type="radio" name="type" value="" onChange="this.form.submit()" {{ empty($request->type) ? 'checked' : '' }}>
                                    <span>All</span>
                                </li>
                                @foreach($fleet as $item)
                                    @php
                                        $checked = $request->type == $item->fleet_slug ? 'checked' : '';
                                    @endphp
                                    <li>
                                        <input type="radio" name="type" value="{{$item->fleet_slug}}" onChange="this.form.submit()" {{$checked}}>
                                        <span>{{$item->fleet_name}}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-9">
                <div class="ticket-information">
                    @if($trip->isNotEmpty())
                        @foreach($trip as $item)
                            <div class="ticket-box">
                                <div class="ticket-box-inner">
                                    <h5 class="bus-name">{{$item->vehicle_name}}</h5>
                                    <span class="bus-type"><i class="fa fa-bus" aria-hidden="true"></i> {{$item->fleet_name}}</span>
                                </div>
                                <div class="ticket-box-inner travel-time">
                                    <div class="bus-time">
                                        @php $start = date('h:i A', strtotime($item->start_time)) @endphp
                                        <p class="time">{{$start}}</p>
                                        <p class="place">{{ isset($pickup_point[0]) ? $pickup_point[0]->location_name : 'N/A' }}</p>
                                    </div>
                                    <div class="bus-time">
                                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                    </div>
                                    <div class="bus-time">
                                        <p class="time text-uppercase">{{date('h:i A', strtotime($start. ' + '.$item->total_time.' hours'))}}</p>
                                        <p class="place">{{ isset($dropping_point[0]) ? $dropping_point[0]->location_name : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="ticket-box-inner book-ticket">
                                    @foreach($ticket_detail ?? [] as $price)
                                        @if($price->fleet_type == $item->fleet_type)
                                            <p class="rent">{{$siteInfo->cur_format}}{{$price->ticket_price}}</p>
                                        @endif
                                    @endforeach
                                    <p class="off-days">Off Days: <span class="badge badge-danger">{{$item->day_off}}</span></p>
                                    <button data-fleet="{{$item->fleet_type}}" data-url="{{url('/ticketbooking/'.$item->trip_id)}}" class="btn btn1 select-trip-seats">Select Seats</button>
                                </div>
                                <div class="ticket-facility">
                                    <span><strong>Facilities :</strong></span>
                                    @php
                                        $fac_icon = explode(',',$item->facility_icon);
                                        $fac_name = explode(',',$item->facility_name);
                                    @endphp
                                    <ul class="">
                                        @for($i=0; $i < count($fac_icon); $i++)
                                            <li class="mx-2" title="{{$fac_name[$i]}}"><i class="{{$fac_icon[$i]}}"></i></li>
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="card p-3">
                            Buses Not Available
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!------/BOOKING-INFORMATION ------>
@stop
