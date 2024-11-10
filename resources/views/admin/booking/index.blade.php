@extends('admin.layouts.app')
@section('title','Booking')
@section('content')
<div class="content-wrapper">
    @component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
        @slot('title') Bookings @endslot
        @slot('add_btn')  @endslot
        @slot('active') Bookings @endslot
    @endcomponent

    @component('admin.layouts.data-table',['thead'=>
        ['S No.','Trip Name','Pickup Point','Dropping Point','Selected Seats','User','Payment_status','Action']
    ])
        @slot('table_id') booking_list @endslot
    @endcomponent
</div>
@stop

@section('pageJsScripts')
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    var table = $("#booking_list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "booking",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'trip_name', name: 'trip_name'},
            {data: 'pickup_point', name: 'pickup_point'},
            {data: 'dropping_point', name: 'dropping_point'},
            {data: 'seats', name: 'seats'},
            {data: 'user_name', name: 'user'},
            {data: 'status', name: 'status'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            }
        ]
    });
</script>
@stop