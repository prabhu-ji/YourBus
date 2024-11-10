@extends('admin.layouts.app')
@section('title','Dashboard')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$vehicles}}</h3>

                <p>Total Vehicles</p>
              </div>
              <div class="icon">
                <i class="fas fa-bu"></i>
              </div>
              <a href="{{url('admin/vehicle')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <!-- <div class="col-lg-3 col-6">
           
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$users}}</h3>

                <p>Total Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{url('admin/users')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$booking}}</h3>

                <p>Total Bookings</p>
              </div>
              <div class="icon">
                <i class="fas fa-calendar-alt"></i>
              </div>
              <a href="{{url('admin/booking')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Latest Bookings</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>S.No.</th>
                      <th>Trip Name</th>
                      <th>Start Point</th>
                      <th>End Point</th>
                      <th>Trip Date</th>
                      <th>User</th>
                      <th>Payment</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($latest_booking->isNotempty())
                    @php $i=0;  @endphp
                    @foreach($latest_booking as $latest)
                    @php $i++;  @endphp
                    <tr>
                      <td>{{$i}}</td>
                      <td>{{$latest->trip_name}}</td>
                      <td>{{$latest->pickup_point}}</td>
                      <td>{{$latest->dropping_point}}</td>
                      <td>{{date('d M, Y',strtotime($latest->journey_date))}}</td>
                      <td>{{$latest->user_name}}</td>
                      <td>{!!($latest->payment_status == '1')? '<span class="badge badge-success">DONE</span>' : '<span class="badge badge-danger">Failed</span>'!!}</td>
                    </tr>
                    @endforeach
                    @else
                      <tr>
                        <td colspan="6" align="center">No Booking Found</td>
                      </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@stop
