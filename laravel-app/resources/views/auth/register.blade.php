@extends('layouts.guest')

@section('title', 'Patient Registration')

@section('content')
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8">
        <div class="card shadow" style="border-radius: 1rem;">
          <div class="card-body p-5">

            <h3 class="mb-4 text-center">Patient Registration</h3>

            <form method="POST" action="{{ route('patient.register') }}">
              @csrf

              <div class="form-group mb-3">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" required>
              </div>

              <div class="form-group mb-3">
                <label>IC Number</label>
                <input type="text" name="ic_number" class="form-control" required>
              </div>

              <div class="form-group mb-3">
                <label>Date of Birth</label>
                <input type="date" name="dob" class="form-control" required>
              </div>

              <div class="form-group mb-3">
                <label>Phone Number</label>
                <input type="text" name="phone_number" class="form-control" required>
              </div>

              <div class="form-group mb-3">
                <label>Gender</label>
                <select name="gender" class="form-control" required>
                  <option value="">-- Select Gender --</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>

              <div class="form-group mb-3">
                <label>Email address</label>
                <input type="email" name="email" class="form-control" required>
              </div>

              <div class="form-group mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
              </div>

              <div class="form-group mb-4">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
              </div>

              <button type="submit" class="btn btn-primary w-100">Register</button>

              <p class="mt-3 text-center">
                Already have an account?
                <a href="{{ route('patient.login') }}">Login here</a>
              </p>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
