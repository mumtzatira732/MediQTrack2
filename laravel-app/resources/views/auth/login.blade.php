@extends('layouts.guest')

@section('content')
<section class="vh-100" style="background-color:rgba(154, 97, 109, 0);">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">

            <!-- Image Section -->
            <div class="col-md-6 col-lg-5 d-none d-md-block p-0">
              <img src="{{ asset('images/image1.jpg') }}"
                   class="img-fluid h-100 w-100"
                   style="object-fit: cover; border-radius: 1rem 0 0 1rem;" />
            </div>

            <!-- Login Form -->
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                {{-- Flash success message --}}
                @if (session('success'))
                  <div class="alert alert-success">
                    {{ session('success') }}
                  </div>
                @endif

                <form method="POST" action="{{ $action }}">
                  @csrf

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                  <!-- Email -->
                  <div class="form-outline mb-3">
                    <label class="form-label" for="email">Email address</label>
                    <input type="email" id="email" name="email"
                           class="form-control form-control-lg @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" required autofocus />
                    @error('email')
                      <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <!-- Password -->
                  <div class="form-outline mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password"
                           class="form-control form-control-lg @error('password') is-invalid @enderror"
                           required />
                    @error('password')
                      <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <!-- Remember Me -->
                  <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                      Remember Me
                    </label>
                  </div>

                  <!-- Submit -->
                  <div class="pt-1 mb-3">
                    <button class="btn btn-lg btn-block" type="submit"
                            style="background-color:rgb(67, 114, 223); color: white; border: none;">
                      Login
                    </button>
                  </div>
                  
                  <!-- Forgot Password -->
                  @if (Route::has('password.request'))
                    <a class="small text-muted" href="{{ route('password.request') }}">Forgot Your Password?</a>
                  @endif

                  @isset($registerLink)
                  <p class="mb-5 pb-lg-2 mt-3" style="color: #393f81;">
                    Don’t have an account?
                    <a href="{{ $registerLink }}" style="color: #393f81;">Register here</a>
                  </p>
                  @endisset

                </form>
              </div>
            </div>
            <!-- End Form Section -->

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
