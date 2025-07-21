@extends('layouts.guest')

@section('title', 'Admin Login')

@section('content')
<section class="vh-100" style="background-color: #f8f9fa;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card shadow" style="border-radius: 1rem;">
          <div class="row g-0">

            <!-- Image Section -->
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="{{ asset('images/image1.jpg') }}"
                   alt="login image"
                   class="img-fluid h-100 w-100"
                   style="object-fit: cover; border-radius: 1rem 0 0 1rem;" />
            </div>

            <!-- Login Form Section -->
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <h3 class="fw-bold mb-4 text-center">Admin Login</h3>

                @if (session('error'))
                  <div class="alert alert-danger">
                    {{ session('error') }}
                  </div>
                @endif

                <form method="POST" action="{{ route('admin.login') }}">
                  @csrf

                  <!-- Email -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control form-control-lg" required />
                  </div>

                  <!-- Password -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control form-control-lg" required />
                  </div>

                  <!-- Submit -->
                  <div class="d-grid mb-4">
                    <button class="btn btn-primary btn-lg w-100" type="submit">Login</button>
                  </div>

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
