<div class="sidebar bg-dark text-white p-3" style="width: 250px; height: 100vh; position: fixed;">
    <h4 class="mb-4">MediQTrack Admin</h4>
    <ul class="nav flex-column">
        <li class="nav-item mb-2">
            <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('admin.users.index') }}" class="nav-link text-white">
                <i class="bi bi-people"></i> Manage Users
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white">
                <i class="bi bi-bar-chart"></i> Reports
            </a>
        </li>
        <li class="nav-item mt-4">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</div>
