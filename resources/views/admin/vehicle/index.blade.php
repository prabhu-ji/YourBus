@extends('admin.layouts.app')
@section('title','All Vehicle')
@section('content')

<div class="content-wrapper">

    @component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
        @slot('title') All Vehicle @endslot
        @slot('add_btn') <a href="{{url('admin/vehicle/create')}}" class="align-top btn btn-sm btn-primary">Add New</a> @endslot
        @slot('active') All Vehicle @endslot
    @endcomponent

    @component('admin.layouts.data-table',['thead'=>
        ['S No.','Name','Reg. No.','Engine No.','Model No.','Fleet Type','Status','Action']
    ])
        @slot('table_id') vehicle_list @endslot
    @endcomponent
</div>

@stop

@section('pageJsScripts')

<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    var table = $("#vehicle_list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "vehicle",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'register_no', name: 'register_no'},
            {data: 'engine_no', name: 'engine_no'},
            {data: 'model_no', name: 'model_no'},
            {data: 'fleet_name', name: 'fleet_name'},
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