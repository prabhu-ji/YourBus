@extends('admin.layouts.app')
@section('title','Location')
@section('content')
<div class="content-wrapper">
    @component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
        @slot('title') Location @endslot
        @slot('add_btn') <a href="{{url('admin/location/create')}}" class="align-top btn btn-sm btn-primary">Add New</a> @endslot
        @slot('active') Location @endslot
    @endcomponent

    @component('admin.layouts.data-table',['thead'=>
        ['S No.','Name','Status','Action']
    ])
        @slot('table_id') location_list @endslot
    @endcomponent
</div>
@stop

@section('pageJsScripts')
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/responsive.bootstrap4.min.js')}}"></script>

<script type="text/javascript">
    var table = $("#location_list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "location",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'location_name', name: 'name'},
            {data: 'status', name: 'status'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            }
        ]
    });

    // Delete functionality
    $(document).on('click', '.delete-location', function () {
        let locationId = $(this).data('id');

        if (confirm("Are you sure you want to delete this location?")) {
            $.ajax({
                url: '/location/' + locationId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    alert(response.message);
                    if (response.success) {
                        // Reload the DataTable to reflect changes
                        table.ajax.reload();
                    }
                },
                error: function (error) {
                    alert('Error deleting location');
                }
            });
        }
    });
</script>
@stop
