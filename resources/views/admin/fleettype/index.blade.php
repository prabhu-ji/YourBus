@extends('admin.layouts.app')
@section('title','Fleet Type')
@section('content')

<div class="content-wrapper">
    @component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
        @slot('title') Fleet Type @endslot
        @slot('add_btn') <a href="{{url('admin/fleettype/create')}}" class="align-top btn btn-sm btn-primary">Add New</a> @endslot
        @slot('active') Fleet Type @endslot
    @endcomponent

    @component('admin.layouts.data-table',['thead'=>
        ['S No.','Name','Seat Layout','Total Seat','Status','Action']
    ])
        @slot('table_id') fleet_list @endslot
    @endcomponent
</div>

@stop

@section('pageJsScripts')

<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    var table = $("#fleet_list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "fleettype",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'fleet_name', name: 'name'},
            {data: 'layout_name', name: 'layout_name'},
            {data: 'total_seats', name: 'total_seats'},
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