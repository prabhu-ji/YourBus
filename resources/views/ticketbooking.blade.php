@extends('layout')
@section('title','Bus Booking')
@section('content')
<!------ Page Head Section ------>
<div class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                  <h2 class="m-0">{{$trip->vehicle_name}} ({{$trip->title}})</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/all-busbooking?pickup_point='.$request->pickup_point.'&dropping_point='.$request->dropping_point.'&departure_date='.$request->departure_date)}}"> <i class="fa fa-arrow-left"></i>  back</a></li>
                        <!-- <li class="breadcrumb-item active" aria-current="page">Ticket Booking</li> -->
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!------/Page Head Section ------>

<!------ TICKET BOOKING FORM ------>
<div class="ticket-booking-form">
    <div class="container">
        <div class="row">
            <div class="offset-md-2 col-md-4">
                <div class="ticket-booking-form-inner">
                    <form action="{{url('confirm-ticket')}}">
                        <input type="hidden" name='id' value="{{$trip->id}}">
                        <div class="form-group">
                            <label for=""><b>Journey Date</b></label>
                            <input type="date" name="departure_date" class="form-control" value="{{$request->departure_date}}" required disabled>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Pickup Point</b></label>
                            <select name="pickup_point" class="form-control" required>
                                @foreach($location as $item)
                                    @if($request->pickup_point == $item->id)
                                        <option value="{{$item->id}}" selected>{{$item->location_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Dropping Point</b></label>
                            <select name="dropping_point" class="form-control" required>
                                @foreach($location as $item)
                                    @if($request->dropping_point == $item->id)
                                        <option value="{{$item->id}}" selected>{{$item->location_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <input type="text" hidden name="type" value="{{$request->type}}">
                            <input type="text" hidden name="departure_date" value="{{$request->departure_date}}">
                            <input type="text" hidden class="form-control" name="seat_list" value="" required>
                        </div>
                        <div class="form-group">
                            <p>Selected Seats</p>
                            <table class="table table-bordered">
                                <thead class="selected-seat">
                                    <th>Seat Details</th>
                                    <th>Price</th>
                                </thead>
                                <tbody class="test">
                                  
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>
                                            <span class="sub-total"></span>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <button class="btn1 btn" style="width:100%;">Continue</button>
                    </form>
                    <input type="text" hidden name="price" value="{{$ticket_price}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="bus-seating">
                    <h6 class="title">Click on Seat to select or deselect {{$trip->layout_name}}</h6>
                    <span class="off-days">Off Days: <span class="badge badge-danger">{{$trip->day_off}}</span></span>
                    <div class="seat-plan-inner">
                        <div class="single">
                            <span class="front">Front</span>
                            <span class="rear">Rear</span>
                            <span class="lower">Door</span>
                            <span class="driver"></span>
                            @php  
                                $seat_layout = explode('X',$trip->layout_name);
                                $line = array_sum($seat_layout);
                                $no_of_lines = $trip->total_seat/$line;
                                $no_of_lines = $no_of_lines-1;
                            @endphp
                            @php $alphabet = range('A', 'Z'); @endphp
                            @php $azRange = range('A', $alphabet[$no_of_lines]); @endphp
                            @foreach ($azRange as $letter)
                            <div class="seat-wrapper">
                                <div class="left-side">
                                    @for($i=1;$i<=$seat_layout[0];$i++)
                                        <div>
                                            @if(!empty($booking->seats))
                                                @php $seats = array_filter(explode(',',$booking->seats));@endphp
                                                @if(in_array($letter.''.$i,$seats))
                                                    <span class="seat active">
                                                        <label for="seat{{$letter}}{{$i}}">{{$letter}}{{$i}}</label>
                                                        <input type="checkbox" disabled id="seat{{$letter}}{{$i}}" class="select-seat"  name="seat_name[]" value="{{$letter}}{{$i}}">
                                                        <span style="display:none;">{{$ticket_price}}</span>
                                                    </span>
                                                @else
                                                    <span class="seat">
                                                        <label for="seat{{$letter}}{{$i}}">{{$letter}}{{$i}}</label>
                                                        <input type="checkbox" id="seat{{$letter}}{{$i}}" class="select-seat"  name="seat_name[]" value="{{$letter}}{{$i}}">
                                                        <span style="display:none;">{{$ticket_price}}</span>
                                                    </span>
                                                @endif
                                            @else
                                                <span class="seat">
                                                    <label for="seat{{$letter}}{{$i}}">{{$letter}}{{$i}}</label>
                                                    <input type="checkbox" id="seat{{$letter}}{{$i}}" class="select-seat"  name="seat_name[]" value="{{$letter}}{{$i}}">
                                                    <span style="display:none;">{{$ticket_price}}</span>
                                                </span>
                                            @endif
                                        </div>
                                    @endfor
                                </div>
                                    @php $j = $seat_layout[0]+1;
                                    $end = $seat_layout[0]+$seat_layout[1];
                                    @endphp
                                <div class="right-side">   
                                    @for($j;$j<=$end;$j++)
                                        <div>
                                            @if($booking->seats != '')
                                                @php $seats = array_filter(explode(',',$booking->seats));@endphp
                                                @if(in_array($letter.''.$j,$seats))
                                                    <span class="seat active">
                                                        <label for="seat{{$letter}}{{$j}}">{{$letter}}{{$j}}</label>
                                                        <input type="checkbox" disabled id="seat{{$letter}}{{$j}}" class="select-seat"  name="seat_name[]" value="{{$letter}}{{$j}}">
                                                        <span style="display:none;">{{$ticket_price}}</span>
                                                    </span>
                                                @else
                                                    <span class="seat">
                                                        <label for="seat{{$letter}}{{$j}}">{{$letter}}{{$j}}</label>
                                                        <input type="checkbox" id="seat{{$letter}}{{$j}}" class="select-seat"  name="seat_name[]" value="{{$letter}}{{$j}}">
                                                        <span style="display:none;">{{$ticket_price}}</span>
                                                    </span>
                                                @endif
                                            @else
                                                <span class="seat">
                                                    <label for="seat{{$letter}}{{$j}}">{{$letter}}{{$j}}</label>
                                                    <input type="checkbox" id="seat{{$letter}}{{$j}}" class="select-seat"  name="seat_name[]" value="{{$letter}}{{$j}}">
                                                    <span style="display:none;">{{$ticket_price}}</span>
                                                </span>
                                            @endif
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="seat-for-reserved">
                    <div class="seat-condition available-seat">
                        <span class="seat">
                            <span></span>
                        </span>
                        <p>Available Seats</p>
                    </div>
                    <div class="seat-condition selected-by-you">
                        <span class="seat">
                            <span></span>
                        </span>
                        <p>Selected by You</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!------.TICKET BOOKING FORM ------>


@stop
