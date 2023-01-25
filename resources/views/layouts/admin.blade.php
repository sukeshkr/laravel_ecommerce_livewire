<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- plugins:css -->
        <link rel="stylesheet" href="{{asset('admin/vendors/mdi/css/materialdesignicons.min.css')}}">
        <link rel="stylesheet" href="admin/vendors/base/vendor.bundle.base.css">
        <!-- endinject -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <!-- Default theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
        <!-- plugin css for this page -->
        <link rel="stylesheet" href="{{asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
        <!-- endinject -->
        <link rel="shortcut icon" href="{{asset('admin/images/favicon.png')}}" />
        <!-- livewire -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">

        <div class="container-scroller">

            @include('layouts.inc.admin.navbar')

            <div class="container-fluid page-body-wrapper">

                @include('layouts.inc.admin.sidebar')

                <div class="main-panel">
                    <div class="content-wrapper">

                        @yield('content')

                    </div>
                </div>

            </div>

        </div>


  <!-- plugins:js -->
  <script src="{{asset('admin/vendors/base/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{asset('admin/vendors/datatables.net/jquery.dataTables.js')}}"></script>
  <script src="{{asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('admin/js/off-canvas.js')}}"></script>
  <script src="{{asset('admin/js/hoverable-collapse.js')}}"></script>
  <script src="admin/js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('admin/js/dashboard.js')}}"></script>
  <script src="{{asset('admin/js/data-table.js')}}"></script>
  <script src="{{asset('admin/js/jquery.dataTables.js')}}"></script>
  <script src="{{asset('admin/js/dataTables.bootstrap4.js')}}"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

 <script>


    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('38131e2ca2b5fdc00db4', {
      cluster: 'ap2'
    });

    var channel = pusher.subscribe('lara-ecom');
    channel.bind('checkout-order', function(data) {

    var canDismiss = false;
    alertify.set('notifier','position', 'top-right');
    var notification = alertify.success(JSON.stringify('Please check your Oreder page...You have a new Order from '+data.order));
    notification.ondismiss = function(){ return canDismiss; };
    setTimeout(function(){ canDismiss = true;}, 5000);

    });
  </script>

  <!-- End custom js for this page-->
    @yield('scripts')
    @livewireScripts
    @stack('script')
    </body>
</html>
