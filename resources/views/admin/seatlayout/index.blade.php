@extends('admin.layouts.app')
@section('title','All Seat Layouts')
@section('content')

<div class="content-wrapper">

    @component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'']])
        @slot('title') Seat Layouts @endslot
        @slot('add_btn') <button class="align-top btn btn-sm btn-primary" data-toggle="modal" data-target="#addSeatModal">Add New</button> @endslot
        @slot('active') Seat Layouts @endslot
    @endcomponent

    @component('admin.layouts.data-table',['thead'=>
        ['S No.','Layout Name','Action']
    ])
        @slot('table_id') seatLayout_list @endslot
    @endcomponent
</div>
<div class="modal fade" id="addSeatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Seat Layout</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST" id="addSeatLayout">
            @csrf
        <div class="modal-body">
            <div class="form-group row">
                <label for="" class="col-md-12">Layout Name</label>
                <input type="number" class="form-control col-md-5" name="layout1">
                <label for="" class="col-md-2 text-center">X</label>
                <input type="number" class="form-control col-md-5" name="layout2">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" name="add" value="Save">
        </div>
        </form>
    </div>
  </div>
</div>
<!-- edit modal -->
<div class="modal fade" id="editSeatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Seat Layout</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST" id="editSeatLayout">
            @csrf
        <div class="modal-body">
        <div class="form-group row">
                <label for="" class="col-md-12">Layout Name</label>
                <input type="number" class="form-control col-md-5 layout1" name="layout1">
                <label for="" class="col-md-2 text-center">X</label>
                <input type="number" class="form-control col-md-5 layout2" name="layout2">
                <input type="text" hidden class="id">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-primary submitSeatLayout">Save</button> -->
            <input type="submit" class="btn btn-primary" name="update" value="Update">
        </div>
        </form>
    </div>
  </div>
</div>

@stop

@section('pageJsScripts')

<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    var table = $("#seatLayout_list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "seat-layout",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'layout_name', name: 'layout_name'},
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

