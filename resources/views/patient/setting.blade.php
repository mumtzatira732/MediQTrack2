@extends('layouts.user')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

           {{-- View Section --}}
            <div id="viewSection">
                <div class="card mb-4 shadow-sm border-0 rounded-4">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-4">Personal Information</h5>
                        <div class="text-center mb-4">
                            <img src="{{ asset('images/profile.jpg') }}" alt="Avatar" class="rounded-circle mx-auto d-block" style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" value="{{ $patient->name }}" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{ $patient->email }}" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">IC Number</label>
                                <input type="text" class="form-control" value="{{ $patient->ic_number }}" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="text" class="form-control" value="{{ $patient->phone_number ?? 'N/A' }}" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input type="text" class="form-control" value="{{ $patient->dob }}" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Gender</label>
                                <input type="text" class="form-control" value="{{ $patient->gender }}" disabled>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button class="btn btn-primary px-4 py-2 rounded-pill" onclick="toggleEdit()">Edit Profile</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Edit Section --}}
            <div id="editSection" style="display: none">
                <form method="POST" action="{{ route('patient.settings.update') }}">
                    @csrf
                    <div class="card mb-4 shadow-sm border-0 rounded-4">
                        <div class="card-body">
                            <h5 class="fw-semibold mb-4">Edit Personal Information</h5>
                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $patient->name }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $patient->email }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">IC Number</label>
                                    <input type="text" name="ic_number" value="{{ $patient->ic_number }}" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" name="phone_number" value="{{ $patient->phone_number }}" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" name="dob" value="{{ $patient->dob }}" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Gender</label>
                                    <select name="gender" class="form-select rounded-3 px-3 py-2 shadow-sm border-0" style="box-shadow: 0 3px 6px rgba(0,0,0,0.1);" required>
                                        <option disabled {{ !$patient->gender ? 'selected' : '' }}>-- Select Gender --</option>
                                        <option value="Male" {{ $patient->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ $patient->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success px-4 rounded-pill">Save</button>
                                <button type="button" class="btn btn-secondary px-4 ms-2 rounded-pill" onclick="toggleEdit()">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Change Password --}}
            <div class="card mb-4 shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h5 class="fw-semibold mb-4">Change Password</h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Old Password</label>
                            <input type="password" class="form-control" placeholder="Enter old password">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control" placeholder="Enter new password">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" placeholder="Confirm new password">
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>

@endsection
