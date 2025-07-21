@extends('layouts.app')

@section('content')
<div class="container py-5">
    @include('includes.alert')

    <div class="card shadow-lg border-0 rounded-4 p-5">
        <h2 class="mb-4 text-center fw-bold text-primary">Edit Profile</h2>

        <form action="{{ route('patient.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Profile Image --}}
            <div class="text-center mb-4">
                <img src="{{ Auth::guard('patient')->user()->profile_image ? asset('storage/' . Auth::guard('patient')->user()->profile_image) : asset('default.png') }}" class="rounded-circle" width="120" height="120" style="object-fit: cover;">
                <div class="mt-2">
                    <input type="file" name="profile_image" class="form-control w-50 mx-auto">
                </div>
            </div>

            {{-- Name --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Name</label>
                <input type="text" name="name" value="{{ old('name', $patient->name) }}" class="form-control" required>
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" value="{{ old('email', $patient->email) }}" class="form-control" required>
            </div>

            {{-- IC Number --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">IC Number</label>
                <input type="text" name="ic_number" value="{{ old('ic_number', $patient->ic_number) }}" class="form-control" required>
            </div>

            {{-- Phone Number --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Phone Number</label>
                <input type="text" name="phone_number" value="{{ old('phone_number', $patient->phone_number) }}" class="form-control" required>
            </div>

            {{-- Date of Birth --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Date of Birth</label>
                <input type="date" name="dob" value="{{ old('dob', $patient->dob) }}" class="form-control" required>
            </div>

            {{-- Gender --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Gender</label>
                <select name="gender" class="form-control" required>
                    <option value="male" {{ $patient->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $patient->gender == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-4 rounded-pill">Update Profile</button>
            </div>
        </form>
    </div>
</div>
@endsection
