@extends('layout')
@section('title','Bus Booking')
@section('content')
<!------ Page Head Section ------>
<div class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                  <h2 class="m-0">My Profile</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!------/Page Head Section ------>
<div class="user-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img src="{{asset('assets/images/user.png')}}" class="img-thumbnail mb-4" alt="">
                <button type="button" value="{{$user->user_id}}" class="btn1 btn btn-block updatebtn" data-toggle="modal" data-target="#exampleModal">
                        Edit <i class="fa fa-pencil"></i>
                    </button>
            </div>
            <div class="col-md-9">
                <div class="profile-box">
                    <table class="table">
                        <tbody class="profile-item">
                            <input type="hidden" name="user_id" value="{{$user->user_id}}">
                            <tr>
                                <td><b>Name:</b></td>
                                <td><span>{{$user->name}}</span></td>
                            </tr>
                            <tr>
                                <td><b>Email:</b></td>
                                <td><span>{{$user->email}}</span></td>
                            </tr>
                            <tr>
                                <td><b>Phone:</b></td>
                                <td><span>{{$user->phone}}</span></td>
                            </tr>
                            <tr>
                                <td><b>City:</b></td>
                                <td><span>{{$user->city}}</span></td>
                            </tr>
                            <tr>
                                <td><b>State:</b></td>
                                <td><span>{{$user->state}}</span></td>
                            </tr>
                            <tr>
                                <td><b>Country:</b></td>
                                <td><span>{{$user->country}}</span></td>
                            </tr>
                            <tr>
                                <td><b>Pin Code:</b></td>
                                <td><span>{{$user->pin_code}}</span></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form class="form-horizontal" method="POST" id="updateprofile">
                                        @csrf
                                        <!-- <input type="hidden" class="url" value="{{url('/updateprofile/'.session()->get('user_id'))}}"> -->
                                        <input type="hidden" name="user_id" id="user_id">
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input type="text" name="name" value="{{$user->name}}" id="name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Phone</label>
                                            <input type="number" name="phone" value="{{$user->phone}}" id="phone" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">City</label>
                                            <input type="text" name="city" id="city" value="{{$user->city}}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">State</label>
                                            <input type="text" name="state" value="{{$user->state}}" id="state" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Country</label>
                                            <input type="text" name="country" value="{{$user->country}}" id="country" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Pin Code</label>
                                            <input type="text" name="code" id="code" value="{{$user->pin_code}}" class="form-control">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn1 btn-secondary" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn1 btn" value="Update">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('pageJsScripts')

<script>
    // $(document).ready(function(){
    //     $(document).on("click", '.updatebtn', function(){
    //         var user_id = $(this).val();
    //         //alert(user_id);
    //         $('#exampleModal').modal('show');

    //         $.ajax({
    //             type: 'GET',
    //             url: '/updateprofile/'+user_id,
    //             success: function(response){
    //                 //console.log(response.user.name);
    //                 $('#user_id').val(user_id);
    //                 $('#name').val(response.user.name);
    //                 $('#phone').val(response.user.phone);
    //                 $('#city').val(response.user.city);
    //                 $('#state').val(response.user.state);
    //                 $('#country').val(response.user.country);
    //                 $('#code').val(response.user.pin_code);
    //             }
    //         });
    //     });
    // });
</script>



@stop