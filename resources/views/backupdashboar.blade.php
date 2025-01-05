<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield('title', 'Klinik Cikijing | Dashboard')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- FontAwesome 5 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

    <!-- Theme style -->
    <link href="{{asset('backend/dist/css/AdminLTE.min.css')}}" rel="stylesheet">

    <!-- AdminLTE Skins -->
    <link href="{{asset('backend/dist/css/skins/skin-blue.min.css')}}" rel="stylesheet">

    <!-- iCheck -->
    <link href="{{asset('backend/plugins/iCheck/flat/blue.css')}}" rel="stylesheet">

    <!-- Morris chart -->
    <link href="{{asset('backend/plugins/morris/morris.css')}}" rel="stylesheet">

    <!-- jvectormap -->
    <link href="{{asset('backend/plugins/jvectormap/jquery-jvectormap-2.0.5.css')}}" rel="stylesheet">

    <!-- Date Picker -->
    <link href="{{asset('backend/plugins/datepicker/datepicker.css')}}" rel="stylesheet">

    <!-- Daterange picker -->
    <link href="{{asset('backend/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Bootstrap wysihtml5 - text editor -->
    <link href="{{asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}" rel="stylesheet">
</head>
<body class="sidebar-mini layout-fixed">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="{{route('dashboard.staff')}}" class="logo">
                <span class="logo-mini"><b>A</b>LT</span>
                <span class="logo-lg"><b>Admin</b>LTE</span>
            </a>
            <!-- Navbar -->
            @include('navbar')
        </header>

        <!-- Sidebar -->
        <aside class="main-sidebar">
            <!-- Sidebar -->
            @include('sidebar')
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <h1>
                        @yield('page-title', 'Dashboard')
                        <small>@yield('page-subtitle', 'Main Dashboard')</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.staff')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="breadcrumb-item active">@yield('breadcrumb', 'Dashboard')</li>
                    </ol>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 2.0
            </div>
            <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
        </footer>
    </div>

    <!-- jQuery -->
<script src="{{asset('backend/plugins/jQuery/jQuery-3.6.0.min.js')}}"></script>

<!-- jQuery UI -->
<script src="{{asset('backend/http://code.jquery.com/ui/1.11.2/jquery-ui.min.js')}}" type="text/javascript"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- Bootstrap 5 JS -->
<script src="{{asset('backend/bootstrap/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>

<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{asset('backend/plugins/morris/morris.min.js')}}" type="text/javascript"></script>

<!-- Sparkline -->
<script src="{{ asset('backend/plugins/sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>

<!-- jvectormap -->
<script src="{{ asset('backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>

<!-- jQuery Knob Chart -->
<script src="{{ asset('backend/plugins/knob/jquery.knob.js') }}" type="text/javascript"></script>

<!-- Daterangepicker -->
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>

<!-- Datepicker -->
<script src="{{ asset('backend/plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}" type="text/javascript"></script>

<!-- iCheck -->
<script src="{{ asset('backend/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>

<!-- Slimscroll -->
<script src="{{ asset('backend/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>

<!-- FastClick -->
<script src="{{ asset('backend/plugins/fastclick/fastclick.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/app.min.js') }}" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('backend/dist/js/pages/dashboard.js') }}" type="text/javascript"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend/dist/js/demo.js') }}" type="text/javascript"></script>


</body>
</html>
