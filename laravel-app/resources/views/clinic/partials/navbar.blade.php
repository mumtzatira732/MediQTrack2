<nav class="navbar navbar-light bg-white border-bottom shadow-sm px-4">
    <span class="navbar-brand mb-0 h4 text-primary fw-bold">MediQTrack Clinic</span>
    <div class="d-flex gap-2">
        <a href="{{ route('clinic.dashboard') }}" class="btn btn-outline-primary">Dashboard</a>
        <form action="{{ route('clinic.logout') }}" method="POST" class="d-inline">
            @csrf
            <button class="btn btn-outline-danger">Logout</button>
        </form>
    </div>
</nav>
