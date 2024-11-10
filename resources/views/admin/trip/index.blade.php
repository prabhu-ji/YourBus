@extends('admin.layouts.app')
@section('title','All Trip')
@section('content')
<div class="content-wrapper">
    @component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
        @slot('title') All Trip @endslot
        @slot('add_btn') <a href="{{url('admin/trip/create')}}" class="align-top btn btn-sm btn-primary">Add New</a> @endslot
        @slot('active') All Trip @endslot
    @endcomponent

    @component('admin.layouts.data-table',['thead'=>
        ['S No.','Title','Vehicle','Route','Start Time','Day Off','Status','Action']
    ])
        @slot('table_id') trip_list @endslot
    @endcomponent
</div>
@stop

@section('pageJsScripts')
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    var table = $("#trip_list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "trip",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'title', name: 'title'},
            {data: 'vehicle_name', name: 'vehicle_name'},
            {data: 'route_name', name: 'route_name'},
            {data: 'start_time', name: 'start_time'},
            {data: 'day_off', name: 'day_off'},
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