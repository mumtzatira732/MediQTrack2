@extends('layouts.user') {{-- or whatever layout you use for guest pages --}}

@section('content')
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
      <div class="card rounded-4 shadow-sm overflow-hidden">
        <div class="row g-0">
          <!-- Left image side -->
          <div class="col-md-5">
            <img src="{{ asset('images/login-side-image.png') }}" alt="Clinic Illustration" class="img-fluid h-100 w-100" style="object-fit: cover;">
          </div>

          <!-- Right form side -->
          <div class="col-md-7 p-4">
            <h3 class="mb-3 text-secondary"><i class="fas fa-sign-in-alt text-warning"></i> Patient Login</h3>
            <p class="text-muted mb-4">Sign into your account</p>

            <form method="POST" action="{{ route('login') }}">
              @csrf

              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                  name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                  name="password" required>
                @error('password')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
              </div>

              <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
              </div>

              <button type="submit" class="btn btn-dark w-100">Login</button>
            </form>

            <div class="mt-2 text-center">
              <a href="{{ route('register') }}">Don't have an account? Register here</a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
