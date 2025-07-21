@extends('layouts.guest')

@section('title', 'Patient Registration')

@section('content')
<section class="vh-100" style="background-color: #f8f9fa;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card mx-auto shadow" style="max-width: 1200px; border-radius: 1rem;">
          <div class="row g-0">

            <!-- Left Image -->
            <div class="col-md-5 col-lg-4 d-none d-md-block p-0">
              <img src="{{ asset('images/image1.jpg') }}"
                   alt="Register form"
                   class="img-fluid h-100 w-100"
                   style="object-fit: cover; border-radius: 1rem 0 0 1rem;" />
            </div>

            <!-- Right Form -->
            <div class="col-md-7 col-lg-8 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black w-100">

              {{-- INSERT THIS --}}
                @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul class="mb-0">
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif

                @if (session('success'))
                  <div class="alert alert-success">
                    {{ session('success') }}
                  </div>
                @endif

                @if (session('error'))
                  <div class="alert alert-danger">
                    {{ session('error') }}
                  </div>
                @endif
                <form method="POST" action="{{ route('patient.register') }}">
                  @csrf

                  <h3 class="fw-bold mb-4 text-center">Patient Registration</h3>

                  <div class="row">
                    <!-- Full Name -->
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Full Name</label>
                      <input type="text" class="form-control" name="name" required value="{{ old('name') }}">
                    </div>

                    <!-- IC Number -->
                    <div class="col-md-6 mb-3">
                      <label class="form-label">IC Number</label>
                      <input type="text" class="form-control" name="ic_number" required value="{{ old('ic_number') }}">
                    </div>
                  </div>

                  <div class="row">
                    <!-- Date of Birth -->
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Date of Birth</label>
                      <input type="date" class="form-control" name="dob" required value="{{ old('dob') }}">
                    </div>

                    <!-- Phone Number -->
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Phone Number</label>
                      <input type="text" class="form-control" name="phone_number" required value="{{ old('phone_number') }}">
                    </div>
                  </div>

                  <!-- Gender -->
                  <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <select class="form-control" name="gender" required>
                      <option value="">-- Select Gender --</option>
                      <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                      <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                  </div>

                  <!-- Email -->
                  <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" required value="{{ old('email') }}">
                  </div>

                  <!-- Password -->
                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                  </div>

                  <!-- Confirm Password -->
                  <div class="mb-4">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" required>
                  </div>

                  <!-- Submit -->
                  <button type="submit" class="btn btn-primary btn-lg w-100">Register</button>

                  <!-- Link -->
                  <p class="mt-4 text-center text-muted">
                    Already have an account?
                    <a href="{{ route('patient.login') }}">Login here</a>
                  </p>
                </form>

              </div>
            </div>
            <!-- End Right Form -->

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
