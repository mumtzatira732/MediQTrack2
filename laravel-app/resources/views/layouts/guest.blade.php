<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Patient Login')</title>

  <!-- Fonts & Styles -->
  <link href="{{ asset('user/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('user/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body class="bg-light">

  <main>
    @yield('content')
  </main>

  <script src="{{ asset('user/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
