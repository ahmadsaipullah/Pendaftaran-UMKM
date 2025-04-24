<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    @include('includes.style');
    <style>
        @keyframes shake {
        0% { transform: rotate(0deg); }
        25% { transform: rotate(3deg); }
        50% { transform: rotate(-3deg); }
        75% { transform: rotate(3deg); }
        100% { transform: rotate(0deg); }
        }
        .animation__shake {
        animation: shake 1.5s infinite;
        transition: transform 0.3s ease;
        }
        </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

  <!-- Preloader -->
  <div class="preloader d-flex flex-column justify-content-center align-items-center"
  style="background: linear-gradient(to bottom right, rgba(34, 193, 195, 0.8), rgba(253, 187, 45, 0.8));
;
         backdrop-filter: blur(8px);
         position: fixed;
         inset: 0;
         z-index: 9999;">
 <img class="animation__shake" src="{{ asset('assets/img/logoft.png') }}" alt="logo" width="120" height="120">
</div>





        <div class="mb-4 pb-4">
            @include('includes.navbar')
        </div>

        @include('includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->
        <div class="mb-4 pb-4">
            @include('includes.footer')

        </div>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('includes.script')
</body>

</html>
