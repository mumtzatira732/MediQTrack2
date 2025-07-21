<head> <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> </head>
<ul class="navbar-nav iq-main-menu" id="sidebar">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
           href="{{ route('admin.dashboard') }}">
            <i class="icon">
                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.4" d="..." fill="currentColor"/>
                    <path d="..." fill="currentColor"/>
                </svg>
            </i>
            <span class="item-name">Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
            <i class="icon bi bi-people"></i>
            <span class="item-name">Manage Users</span>
        </a>
    </li>
    <li class="nav-item">
    <a class="nav-link collapsed" data-bs-toggle="collapse" href="#clinicMenu" role="button"
       aria-expanded="false" aria-controls="clinicMenu">
        <i class="icon bi bi-hospital"></i>
        <span class="item-name">Manage Clinic</span>
    </a>
    <div class="collapse" id="clinicMenu">
        <ul class="nav flex-column ms-3">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.clinics.index') ? 'active' : '' }}" href="{{ route('admin.clinics.index') }}">
                    <i class="bi bi-list-ul"></i> List of Clinics
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.clinics.pending') ? 'active' : '' }}" href="{{ route('admin.clinics.pending') }}">
                    <i class="bi bi-hourglass-split"></i> Pending Approvals
                </a>
            </li>
        </ul>
    </div>
</li>
    
</ul>
