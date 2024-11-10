@extends('layout')
@section('title','Bus Management')

@section('content')
<!------ BANNER ------>

@foreach($banner as $item)
    <div id="banner" style="background-image: url({{ asset('banner/' . ($item->banner_img && file_exists(public_path('banner/'.$item->banner_img)) ? $item->banner_img : 'default-banner.jpg')) }})">
        <div class="container-xl container-fluid">
            <div class="row">
                <div class="offset-md-6 col-md-6">
                    <div class="banner-description">
                        <h1>{{ $item->title }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!------/BANNER ------>

<!------ BOOKING-FORM ------>
<div class="booking-form">
    <div class="container-xl container-fluid">
        <h2 class="section-heading">Choose Your Ticket</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="booking-img">
                    <img src="{{asset('assets/images/bus.jpg')}}" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="booking-form-inner h-100">
                    <form action="{{url('all-busbooking')}}">
                        <div class="form-group">
                            <label for=""><b>Pickup Point</b></label>
                            <select name="pickup_point" id="" class="form-control select2" required>
                                <option value="">Select Pickup Point</option>
                                @foreach($location as $item)
                                    <option value="{{$item->id}}">{{$item->location_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Dropping Point</b></label>
                            <select name="dropping_point" id="" class="form-control select2" required>
                                <option value="">Select Dropping Point</option>
                                @foreach($location as $item)
                                    <option value="{{$item->id}}">{{$item->location_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Departure Date</b></label>
                            <input type="date" class="form-control" name="departure_date" value="{{date('Y-m-d')}}" required>
                        </div>
                        <div class="form-group m-0">
                            <button type="submit" class="btn1 btn">Find Tickets</button>
                        </div>                  
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!------/BOOKING-FORM ------>

<!------ OUR-FACILITY ------>
<div class="our-facility">
    <div class="container-xl container-fluid">
        <h2 class="section-heading">Our Facilities</h2>
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel owl-theme">
                    @foreach($facility as $item)
                    <div class="item">
                        <div class="facility-box">
                            <span class="icon"><i class="{{ $item->icon }}"></i></span>
                            <h4 class="title">{{ $item->facility_name }}</h4>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!------/OUR-FACILITY ------>

@stop
