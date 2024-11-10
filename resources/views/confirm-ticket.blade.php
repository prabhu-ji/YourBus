@extends('layout')
@section('title','Confirm Ticket')
@section('content')
<!------ Page Head Section ------>
<div class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                  <h2 class="m-0">Confirm Ticket</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Confirm Ticket</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!------/Page Head Section ------>

<div class="confirm-ticket-form">
    <div class="container">
        <div class="row">
            
        <div class="offset-md-2 col-md-8">
                <h3 class="confirm-heading">Ticket Information</h3>
                <form action="{!! URL::to('paypal') !!}" method="POST">
                    <input type="hidden" name="trip_id" value="@php echo $request->id; @endphp">
                    @csrf
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><b>Pickup Point:</b></td>
                                <td>{{$pickup_point->location_name}}</td>
                                <input type="hidden" name="pickup_point" value="{{$pickup_point->location_name}}">
                            </tr>
                            <tr>
                                <td><b>Dropping Point:</b></td>
                                <td>{{$dropping_point->location_name}}</td>
                                <input type="hidden" name="dropping_point" value="{{$dropping_point->location_name}}">
                            </tr>
                            <tr>
                                <td><b>Selected Seats:</b></td>
                                <td>@php echo $request->seat_list;  @endphp</td>
                                <input type="hidden" name="seat" value="@php echo $request->seat_list; @endphp">
                            </tr>
                            <tr>
                                <td><b>Journey Date:</b></td>
                                <td>@php echo date('d M, Y',strtotime($request->departure_date));  @endphp</td>
                                <input type="hidden" name="departure_date" value="@php echo $request->departure_date; @endphp">
                            </tr>
                            <tr>
                                <td><b>Ticket Price:</b></td>
                                    
                                    @if($request->seat_list != '')
                                        @php  $seat_array = array_filter(explode(',',$request->seat_list)); @endphp
                                        @php  $total_price = $ticket_price * count($seat_array); @endphp 
                                    @else
                                        @php $total_price = $ticket_price * 0; @endphp
                                    @endif
                                <td>{{$siteInfo->cur_format}}{{$total_price}}</td>
                            </tr>
                            <tr>
                                <td><b>Ticket Tax:</b></td>
                                <td>{{$siteInfo->tax}}%</td>
                            </tr>
                            <tr>
                                <td><b>Total Ticket Price:</b></td>
                                @php
                                    $price = $total_price;
                                    $taxRate = $siteInfo->tax;
                                    $taxtotal= $price*$taxRate/100;
                                    $total = $price+$taxtotal;
                                @endphp
                                <td>{{$siteInfo->cur_format}}{{$total}}</td>
                                <input type="hidden" name="amount" value="{{$total}}">
                            </tr>
                            <tr>
                                <td><b>User Name:</b></td>
                                <td>{{$user->name}}</td>
                            </tr>
                            <tr>
                                <td><b>User Email:</b></td>
                                <td>{{$user->email}}</td>
                            </tr>
                            <tr>
                                <td><b>User Phone:</b></td>
                                <td>{{$user->phone}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn1 btn">Checkout</button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop