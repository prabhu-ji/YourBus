@extends('layout')
@section('title','Confirm Ticket')
@section('content')
<!------ Page Head Section ------>
<div class="page-heading py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                  <h2 class="m-0">My Bookings</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Bookings</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!------/Page Head Section ------>
<div id="user-content" class="py-5">
    <div class="container table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <th>S No.</th>
                <th>Vehicle Name</th>
                <th>Pickup Point</th>
                <th>Dropping Point</th>
                <th>Selected Seats</th>
                <th>Journey Date</th>
                <th>Payment</th>
            </thead>
            <tbody style="background:#fff;">
                @if($my_bookings->isNotEmpty())
                @php $id = 0; @endphp
                @foreach($my_bookings as $item)
                   @php $id++; @endphp
                <tr>
                    <td>{{$id}}</td>
                    <td>{{$item->vehicle_name}}</td>
                    <td>{{$item->pickup_point}}</td>
                    <td>{{$item->dropping_point}}</td>
                    <td>{{$item->seats}}</td>
                    <td>{{date('d M, Y',strtotime($item->journey_date))}}</td>
                    <td>{!!($item->payment_status == '1')? '<span class="badge badge-success">DONE</span>' : '<span class="badge badge-danger">Failed</span>'!!}</td>
                </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="6" align="center">No Bookings Found <a href="{{url('all-busbooking?pickup_point=&dropping_point=')}}" class="btn1 btn">Start Booking</a> </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <ul class='pagination justify-content-center'>
            <li>{{$my_bookings->appends(request()->query())->links()}}</li>
        </ul>
    </div>
</div>



@stop