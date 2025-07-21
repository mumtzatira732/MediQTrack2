@extends('layouts.guest')
<title>@yield('title', 'Clinic Register')</title>
@section('content')
<section class="vh-100" style="background-color:rgba(154, 97, 109, 0);">
  <div class="container py-5 h-500" style="padding-bottom: 500px;">
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

            <!-- Register Form -->
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul class="mb-0">
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif

                <form method="POST" action="{{ route('clinic.register') }}" enctype="multipart/form-data">
                  @csrf

                  <h3 class="fw-bold text-dark mb-4">Register Your Clinic</h3>

                  <!-- Clinic Name -->
                  <div class="mb-3">
                    <label class="form-label">Clinic Name</label>
                    <input type="text" name="clinic_name" class="form-control" value="{{ old('clinic_name') }}" required>
                  </div>

                  <!-- Email -->
                  <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                  </div>

                  <!-- Password + Confirm -->
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Confirm Password</label>
                      <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                  </div>

                  <!-- Phone + License No -->
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label class="form-label">Clinic Phone Number</label>
                      <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">KKM License Number</label>
                      <input type="text" name="license_no" class="form-control" value="{{ old('license_no') }}" required>
                    </div>
                  </div>

                  <!-- Address Autofill -->
                  <div class="mb-3">
                    <label class="form-label">Clinic Address</label>
                    <input type="text" id="address" name="address" class="form-control" value="{{ old('address') }}" readonly required>
                  </div>

                  <!-- Hidden Lat/Lon -->
                  <input type="hidden" id="latitude" name="latitude">
                  <input type="hidden" id="longitude" name="longitude">

                  <!-- Detect Button -->
                  <div class="mb-3">
                    <button type="button" class="btn btn-outline-secondary" onclick="detectLocation()">📍 Detect My Location</button>
                  </div>

                  <!-- Upload Clinic License -->
                  <div class="mb-4">
                    <label class="form-label">Upload Clinic License</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="license_file" name="license_file" accept=".pdf,.jpg,.jpeg,.png" required>
                      <label class="custom-file-label" for="license_file">Choose file</label>
                    </div>
                    <div class="form-text">Accepted formats: PDF, JPG, JPEG, PNG</div>
                  </div>

                  <!-- Submit -->
                  <div class="mb-3">
                    <button type="submit" class="btn btn-primary btn-lg w-100">Register</button>
                  </div>

                  <p class="text-muted mb-0">
                    Already have an account? <a href="{{ route('clinic.login') }}">Login here</a>
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

<!-- SCRIPT: Detect Location -->
<script>
  async function detectLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(async function (position) {
        const lat = position.coords.latitude;
        const lon = position.coords.longitude;
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lon;

        const apiKey = 'AIzaSyB0SfCXX_Ux-s5mt2VDl9qYDGgHzBFZVWI'; // Ganti dengan API key sebenar
        const response = await fetch(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lon}&key=${apiKey}`);
        const data = await response.json();
        const address = data.results[0]?.formatted_address || 'Address not found';
        document.getElementById('address').value = address;
      }, function (error) {
        alert('Error detecting location: ' + error.message);
      });
    } else {
      alert("Geolocation not supported.");
    }
  }
</script>

<!-- SCRIPT: File name display -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('license_file');
    const label = input.nextElementSibling;

    input.addEventListener('change', function (e) {
      const fileName = e.target.files[0]?.name || 'Choose file';
      label.textContent = fileName;
    });
  });
</script>
@endsection
