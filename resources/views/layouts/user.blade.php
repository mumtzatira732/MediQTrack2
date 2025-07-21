<!DOCTYPE html>
<html lang="en">
<style>
/* Besarkan sidebar width */


.sidebar {
    width: 280px !important; /* default is 250px or so */
}


/* Besarkan teks sidebar */
.sidebar .nav-link span {
    font-size: 1.1rem !important;
}

/* Besarkan title atas sidebar */
.sidebar .sidebar-brand-text {
    font-size: 1.5rem !important;
}
</style>


<head>
  <link href="{{ asset('user/css/custom.css') }}" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'User Panel')</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700" rel="stylesheet">

  <!-- SB Admin 2 CSS -->
  <link href="{{ asset('user/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('user/css/sb-admin-2.min.css') }}" rel="stylesheet">


  <link rel="stylesheet" href="{{ asset('css/patient-custom.css') }}">

</head>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('patient.partials.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('patient.partials.navbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          @yield('content')
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scripts -->
  <script src="{{ asset('user/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('user/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('user/js/sb-admin-2.min.js') }}"></script>
</body>

</html>
