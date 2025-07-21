@extends('layouts.guest')
<title>@yield('title', 'Clinic Login')</title>
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

                @if (session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul class="mb-0">
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif

                <form method="POST" action="{{ route('clinic.login') }}">
                  @csrf

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your clinic account</h5>

                  <!-- Email -->
                  <div class="form-outline mb-3">
                    <label class="form-label" for="email">Email address</label>
                    <input type="email" id="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}" required autofocus />
                  </div>

                  <!-- Password -->
                  <div class="form-outline mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control form-control-lg" required />
                  </div>

                  <!-- Submit -->
                  <div class="pt-1 mb-4">
                    <button class="btn btn-lg btn-block" type="submit" style="background-color:rgb(67, 114, 223); color: white; border: none;">Login</button>
                  </div>

                  <p class="mb-5 pb-lg-2" style="color: #393f81;">
                    Don’t have an account?
                    <a href="{{ route('clinic.register') }}" style="color: #393f81;">Register here</a>
                  </p>

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
