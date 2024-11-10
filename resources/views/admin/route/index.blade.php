@extends('admin.layouts.app')
@section('title','All Route')
@section('content')

<div class="content-wrapper">
    @component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
        @slot('title') All Routes @endslot
        @slot('add_btn') <a href="{{url('admin/route/create')}}" class="align-top btn btn-sm btn-primary">Add New</a> @endslot
        @slot('active') All Routes @endslot
    @endcomponent

    @component('admin.layouts.data-table',['thead'=>
        ['S No.','Name','Starting Point','Ending Point','Distance in KM','Time in Hours','Status','Action']
    ])
        @slot('table_id') route_list @endslot
    @endcomponent
</div>
@stop

@section('pageJsScripts')

<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    var table = $("#route_list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "route",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'route_name', name: 'route_name'},
            {data: 'start_name', name: 'start_name'},
            {data: 'end_name', name: 'end_name'},
            {data: 'total_distance', name: 'total_distance'},
            {data: 'total_time', name: 'total_time'},
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