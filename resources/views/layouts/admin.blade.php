<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/hope-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/dark.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/customizer.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/rtl.css') }}">
</head>
<body>
    <div class="d-flex w-100">
        {{-- Sidebar only --}}
        @include('admin.partials._body_sidebar')

        {{-- Main content --}}
        <main class="main-content flex-grow-1 d-flex flex-column">
            {{-- Header --}}
            @include('admin.partials._body_header')

            {{-- Page content --}}
            <div class="container-fluid content-inner mt-3">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
