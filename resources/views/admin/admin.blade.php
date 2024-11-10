<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/css/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('assets/css/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/sweetalert-bootstrap-4.min.css')}}">
  <style>
    .error{
        color: red;
    }
    </style>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>{{$siteInfo->site_name}}</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
            <form id="adminLogin" method="POST"> 
                @csrf
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Username" autofocus>
                </div>
                <div class="form-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
                </div>
                <input type="submit" class="btn btn-primary" name="login" value="login"/>
            </form>
            </div>
            <!-- /.login-card-body -->
        </div>
        </div>
        <!-- /.login-box -->
        <input type="text" id="url" value="{{url('/')}}" hidden>
    <!-- jQuery -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/js/adminlte.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/js/additional-methods.min.js')}}"></script>
    <script src="{{asset('assets/js/admin-login.js')}}"></script>
    <script>
</script> 
@yield('pageJsScripts')
</body>
</html>