@extends('admin.layouts.app')
@section('title','All Ticket Price')
@section('content')

<div class="content-wrapper">
    @component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
        @slot('title') All Ticket Price @endslot
        @slot('add_btn') <a href="{{url('admin/ticket-price/create')}}" class="align-top btn btn-sm btn-primary">Add New</a> @endslot
        @slot('active') All Ticket Price @endslot
    @endcomponent

    @component('admin.layouts.data-table',['thead'=>
        ['S No.','Fleet Type','Route','Price','Action']
    ])
        @slot('table_id') ticket_list @endslot
    @endcomponent
</div>

@stop

@section('pageJsScripts')

<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    var table = $("#ticket_list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "ticket-price",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'fleet_name', name: 'fleet_name'},
            {data: 'route_name', name: 'route_name'},
            {data: 'ticket_price', name: 'ticket_price'},
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