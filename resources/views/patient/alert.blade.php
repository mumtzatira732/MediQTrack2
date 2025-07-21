@if(session('alert'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session('alert') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
