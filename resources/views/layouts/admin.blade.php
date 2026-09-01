<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Makka Construction</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('public/assets/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{asset('public/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/assets/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/assets/plugins/daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" href="{{asset('public/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/assets/plugins/summernote/summernote-bs4.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/assets/plugins/codemirror/codemirror.css')}}">
  <link rel="stylesheet" href="{{asset('public/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.css')}}">
  <link rel="stylesheet" href="{{asset('public/assets/plugins/select2/css/select2.css')}}">
  <link rel="stylesheet" href="{{asset('public/assets/css/admin.css')}}">
  <link rel="stylesheet" href="{{asset('public/assets/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/bootstrap-multiselect.css')}}">

  <link rel="stylesheet" type="text/css" href="{{asset('public/assets/toast/toastr.css')}}">
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('public/assets/plugins/codemirror/theme/monokai.css')}}">
  <link href="{{ asset('public/assets/css/sweetalert.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a class="dropdown-item" href="{{url('superadmin/usereditprofiler') }}"><i class="fas fa-user"></i> <b>Profile</b></a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();"><i class="fas fa-sign-out-alt"></i> <b>Logout</b></a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- Main Sidebar Container -->
  @include('layouts.menu')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content" style="padding-top: 20px">
      @if (session('success'))
          <div class="row mb-2">
              <div class="col-lg-12">
                  <div class="alert alert-success" role="alert"> {{ session('success') }}</div>
              </div>
          </div>
      @endif
      @if (session('error'))
          <div class="row mb-2">
              <div class="col-lg-12">
                  <div class="alert alert-danger" role="alert"> {{ session('error') }}</div>
              </div>
          </div>
      @endif
      @if (session('warning'))
          <div class="row mb-2">
              <div class="col-lg-12">
                  <div class="alert alert-warning" role="alert"> {{ session('warning') }}</div>
              </div>
          </div>
      @endif
      @if ($errors->count() > 0)
          <div class="alert alert-danger">
              <ul class="list-unstyled">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      @yield('content')
    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong> </strong>
    <div class="float-right d-none d-sm-inline-block">
      <b></b>
    </div>
  </footer>
  <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
  </form>
</div>

<script src="{{asset('public/assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{asset('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('public/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/codemirror/codemirror.js')}}"></script>
<script src="{{asset('public/assets/plugins/codemirror/mode/css/css.js')}}"></script>
<script src="{{asset('public/assets/plugins/codemirror/mode/xml/xml.js')}}"></script>
<script src="{{asset('public/assets/plugins/codemirror/mode/htmlmixed/htmlmixed.js')}}"></script>
<script src="{{asset('public/assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/select2/js/select2.full.js')}}"></script>
<script src="{{asset('public/assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('public/assets/js/sweetalert.js') }}"></script>
<script src="{{asset('public/assets/js/adminlte.js')}}"></script>
<script src="{{asset('public/assets/js/bootstrap-multiselect.js')}}"></script>


<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

@include('layouts.sweetalert')
</body>
</html>
<script>
    $(document).ready(function(){
        setTimeout(function() {
            $('.alert-success').fadeOut('fast');
        }, 2000);
    });
</script>
<script>
    $(document).ready(function(){
        setTimeout(function() {
            $('.alert-danger').fadeOut('fast');
        }, 2000);
    });
</script>
<script>
    $(document).ready(function(){
        setTimeout(function() {
            $('.alert-warning').fadeOut('fast');
        }, 2000);
    });
</script>
