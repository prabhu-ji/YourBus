<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="site-url" content="{{ url('/') }}">
  <link rel="stylesheet" href="{{asset('assets/css/mdtimepicker.min.css')}}">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('assets/css/iconpicker.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{asset('assets/css/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/sweetalert-bootstrap-4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
      Admin
      </a>
      <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
        <a href="{{url('/admin/profile-settings')}}" class="dropdown-item">Profile Settings</a>
        <div class="dropdown-divider"></div>
        <a href="javascript:void(0)" class="dropdown-item admin-logout">Logout</a>
      </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light">{{$siteInfo->site_name}}</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="javascript:void(0)" class="d-block">{{session()->get('admin_name')}}</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{url('admin/dashboard')}}" class="nav-link {{(Request::path() == 'admin/dashboard')? 'active':''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview {{(Request::path() == 'admin/seat-layout' || Request::path() == 'admin/fleettype' || Request::path() == 'admin/vehicle')? 'menu-open':''}}">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-bus"></i>
              <p>Manage Fleets <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ">
                <a href="{{url('admin/seat-layout')}}" class="nav-link {{(Request::path() == 'admin/seat-layout')? 'active bg-primary':''}}">
                  <p>Seat Layouts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/fleettype')}}" class="nav-link {{(Request::path() == 'admin/fleettype')? 'active bg-primary':''}}">
                  <p>Fleet Type</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/vehicle')}}" class="nav-link {{(Request::path() == 'admin/vehicle')? 'active bg-primary':''}}">
                  <p>Vehicles</p>
                </a>
              </li>
            </ul> 
          </li>
          <li class="nav-item has-treeview {{(Request::path() == 'admin/route' || Request::path() == 'admin/ticket-price' || Request::path() == 'admin/trip' || Request::path() == 'admin/assigned-vehicle')? 'menu-open':''}}">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-bus"></i>
              <p>Manage Trips <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/route')}}" class="nav-link {{(Request::path() == 'admin/route')? 'active bg-primary':''}}">
                  <p>Route</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/ticket-price')}}" class="nav-link {{(Request::path() == 'admin/ticket-price')? 'active bg-primary':''}}">
                  <p>Ticket Price</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/trip')}}" class="nav-link {{(Request::path() == 'admin/trip')? 'active bg-primary':''}}">
                  <p>Trip</p>
                </a>
              </li>
            </ul> 
          </li>
          <li class="nav-item">
            <a href="{{url('admin/facility')}}" class="nav-link {{(Request::path() == 'admin/facility')? 'active':''}}">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Facilities
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/location')}}" class="nav-link {{(Request::path() == 'admin/location')? 'active':''}}">
              <i class="nav-icon fas fa-map-marker-alt"></i>
              <p>
                Location
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/users')}}" class="nav-link {{(Request::path() == 'admin/users')? 'active':''}}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/booking')}}" class="nav-link {{(Request::path() == 'admin/booking')? 'active':''}}">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Bookings
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/contact')}}" class="nav-link {{(Request::path() == 'admin/contact')? 'active':''}}">
              <i class="nav-icon fas fa-comment"></i>
              <p>
                Contact Message
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview {{(Request::path() == 'admin/general-settings' || Request::path() == 'admin/profile-settings' || Request::path() == 'admin/banner-settings' || Request::path() == 'admin/social-settings')? 'menu-open':''}}">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>Settings <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/general-settings')}}" class="nav-link {{(Request::path() == 'admin/general-settings')? 'active bg-primary':''}}">
                  <p>General Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin/profile-settings')}}" class="nav-link {{(Request::path() == 'admin/profile-settings')? 'active bg-primary':''}}">
                  <p>Profile Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/banner-settings')}}" class="nav-link {{(Request::path() == 'admin/banner-settings')? 'active bg-primary':''}}">
                  <p>Banner Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/social-settings')}}" class="nav-link {{(Request::path() == 'admin/social-settings')? 'active bg-primary':''}}">
                  <p>Social Links Settings</p>
                </a>
              </li>
            </ul> 
          </li>
        </ul>
      </nav>
    </div>
  </aside>
  @yield('content')
  <input type="text" hidden id="url" value="{{url('/')}}">
  <footer class="main-footer">
  <strong>Copyright <?php echo date('Y'); ?> <a href="https://github.com/prabhu-ji">Prabhu Ji</a>.</strong>
    All rights reserved
</footer> 
  <aside class="control-sidebar control-sidebar-dark">
  </aside>

</div>

<script type="text/javascript" src="{{asset('assets/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('assets/js/mdtimepicker.min.js')}}"></script>
<script src="{{asset('assets/js/iconpicker.js')}}"></script>
<script src="{{asset('assets/js/adminlte.min.js')}}"></script>
<script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/js/additional-methods.min.js')}}"></script>
<script src="{{asset('assets/js/main_ajax.js')}}"></script>
<script>
  $(document).ready(function(){
    $('.select2').select2();
    
  });

  $('#target').on('change', function(e) {
    $("#icon").val(e.icon);
  });

  const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        showCloseButton: false,
        timer: 3000,
        timerProgressBar:false,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
  });
  setTimeout(() => {
    window.addEventListener('alert',({detail:{type,message}})=>{
        
          Toast.fire({
            icon:type,
            title:message
          });
    });
  });

  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
  }

  function myFunction() {
    var checkBox = document.getElementById("myCheck");
    var text = document.getElementById("stoppage");
    if (checkBox.checked == true){
      text.style.display = "block";
    } else {
      text.style.display = "none";
    }
  }

  $(document).ready(function(){
	  $('#timepicker').mdtimepicker();
	});

  $(document).ready(function(){
	  $('#timepicker1').mdtimepicker();
	});
</script> 
@yield('pageJsScripts')
</body>
</html>
