@extends('admin.layouts.app')
@section('title','Contact Message')
@section('content')
<div class="content-wrapper">
    @component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
        @slot('title') Contact Message @endslot
        @slot('add_btn')  @endslot
        @slot('active') Contact Message @endslot
    @endcomponent

    @component('admin.layouts.data-table',['thead'=>
        ['S No.','Name','Email','Action']
    ])
        @slot('table_id') message_list @endslot
    @endcomponent
</div>
@stop

@section('pageJsScripts')
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    var table = $("#message_list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "contact",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
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