@extends('admin.layouts/app')
@section('title','Profile Settings')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.layouts.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
        @slot('title') Profile Settings @endslot
        @slot('add_btn') @endslot
        @slot('active') Profile Settings @endslot
    @endcomponent
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- form start -->
            <form class="form-horizontal" id="updateProfile">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                    <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="d-block bg-primary p-2 mb-3" style="border-radius:5px;">Admin Details</span>
                                        <div class="form-group">
                                            <label>Admin Name</label>
                                            <input type="text" class="form-control" name="admin_name" value="{{$data->admin_name}}"  placeholder="Enter Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Admin Email</label>
                                            <input type="email" class="form-control" name="admin_email" value="{{$data->admin_email}}"  placeholder="Enter Email">
                                        </div>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" name="username" value="{{$data->username}}"  placeholder="Enter Username">
                                        </div>
                                        <button class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </form> <!-- /.form start -->

            <form class="form-horizontal" id="updatePassword">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                    <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="d-block bg-primary p-2 mb-3" style="border-radius:5px;">Change Password</span>
                                        <div class="form-group">
                                            <label>Old Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Old Password">
                                        </div>
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="password" class="form-control" name="new_pass" id="new-pass" placeholder="Enter New Password">
                                        </div>
                                        <div class="form-group">
                                            <label>Re-enter New Password</label>
                                            <input type="password" class="form-control" name="re_pass"  placeholder="Re-enter New Password">
                                        </div>
                                        <button class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </form> <!-- /.form start -->
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection