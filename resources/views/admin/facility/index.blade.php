@extends('admin.layouts.app')
@section('title','Facilities')
@section('content')
<div class="content-wrapper">
    @component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
        @slot('title') Facilities @endslot
        @slot('add_btn') <a href="{{url('admin/facility/create')}}" class="align-top btn btn-sm btn-primary">Add New</a> @endslot
        @slot('active') Facilities @endslot
    @endcomponent

    @component('admin.layouts.data-table',['thead'=>
        ['S No.','Facility Name','Icon','Status','Action']
    ])
        @slot('table_id') facility_list @endslot
    @endcomponent
</div>
@stop

@section('pageJsScripts')
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    var table = $("#facility_list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "facility",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'facility_name', name: 'facility_name'},
            {data: 'icon', name: 'icon'},
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