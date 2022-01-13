<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AdminLTE 3 | Dashboard 2</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('css/admin_css/adminlte.min.css') }}">
    <link  rel="stylesheet" href="{{ url('plugins/sweetalert2/sweetalert2.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <!-- Navbar -->
@include('layouts.admin_layout.admin_header')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
@include('layouts.admin_layout.admin_sidebar')

    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    @include('layouts.admin_layout.admin_footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('js/admin_js/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ url('js/admin_js/demo.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ url('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ url('plugins/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ url('plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ url('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ url('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ url('plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ url('js/admin_js/pages/dashboard2.js') }}"></script>

<!-- CUSTOM SCRIPTS -->
<script src="{{ url('js/admin_js/admin_scripts.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script>
    const actionURL = "{{  \LaravelLocalization::localizeURL(config('admin_urls.admin_name'))}}";
    const checkPasswordTrue ="{{ trans('validation.checkPassword.true') }}";
    const sweetAlertDeleteTitle ="{{ trans('delete.sweetAlertDelete.title') }}";
    const sweetAlertDeleteText ="{{ trans('delete.sweetAlertDelete.text') }}";
    const sweetAlertDeleteIcon ="{{ trans('delete.sweetAlertDelete.icon') }}";
    const sweetAlertDeleteConfirmButtonText ="{{ trans('delete.sweetAlertDelete.confirmButtonText') }}";
    const sweetAlertDeleteCancelButtonText ="{{ trans('delete.sweetAlertDelete.cancelButtonText') }}";
    const sweetAlertDeleteAfter1 ="{{ trans('delete.sweetAlertDelete.afterDelete1') }}";
    const sweetAlertDeleteAfter2 ="{{ trans('delete.sweetAlertDelete.afterDelete2') }}";
    const sweetAlertDeleteAfter3 ="{{ trans('delete.sweetAlertDelete.afterDelete3') }}";
</script>

</body>
</html>

