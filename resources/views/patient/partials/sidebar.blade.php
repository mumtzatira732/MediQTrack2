<link rel="stylesheet" href="{{ asset('css/patient-custom.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="width: 260px; font-size: 1.1rem;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex flex-column align-items-center justify-content-center py-5" href="{{ url('/home') }}">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 60px; margin-bottom: 12px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.2);">

        <div class="text-white text-center fw-bold" style="font-size: 18px; line-height: 1.5;" title="{{ Auth::guard('patient')->user()->name }}">
        {{ Str::limit(Auth::guard('patient')->user()->name, 15) }}
        </div>

    </a>




    <!-- Divider -->
     <br>
     <br>
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Home -->
    <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/patient/home') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span>
        </a>
    </li>

    <!-- Nav Item - History -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('patient.history') }}">
            <i class="fas fa-history"></i>
            <span>History</span>
        </a>
    </li>

    <!-- Nav Item - Settings -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('patient.settings') }}">
            <i class="fas fa-cog"></i>
            <span>Settings</span>
        </a>
    </li>
</ul>
