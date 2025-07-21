@extends('layouts.admin')

@section('title', 'Add Clinic')

@section('content')
<div class="container mt-4">
    <div class="bg-white shadow p-4 rounded">
        <h4 class="mb-4">Add New Clinic</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.clinics.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Clinic Name</label>
                <input type="text" name="clinic_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">License Number</label>
                <input type="text" name="license_no" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Upload License File</label>
                <input type="file" name="license_file" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                <small class="form-text text-muted">Accepted formats: PDF, JPG, JPEG, PNG</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Latitude</label>
                <input type="text" name="latitude" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Longitude</label>
                <input type="text" name="longitude" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Radius (meters)</label>
                <input type="number" step="1" name="radius" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="text-end">
                <a href="{{ route('admin.clinics.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
                <button type="submit" class="btn btn-success btn-sm">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
