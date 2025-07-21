<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container-fluid">

        <!-- Empty flex to push brand to center -->
        <div class="d-flex flex-grow-1"></div>

        

        <div class="d-flex align-items-center order-1">
           

            <!-- Logout -->
            <a href="{{ route('patient.logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="btn btn-outline-primary">
                Logout <i class="fas fa-sign-out-alt ms-1"></i>
            </a>

            <form id="logout-form" action="{{ route('patient.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

    </div>
</nav>
