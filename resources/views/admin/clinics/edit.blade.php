@extends('layouts.admin')

@section('title', 'Edit Clinic')

@section('content')
<div class="container mt-4">
    <div class="bg-white shadow rounded p-4">
        <h4 class="mb-4">Edit Clinic</h4>

        <form method="POST" action="{{ route('admin.clinics.update', ['id' => $clinic->clinic_id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label text-uppercase small">Clinic Name</label>
                <input type="text" class="form-control" name="clinic_name" value="{{ $clinic->clinic_name }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label text-uppercase small">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $clinic->email }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label text-uppercase small">Clinic Phone Number</label>
                <input type="text" class="form-control" name="phone" value="{{ $clinic->phone }}">
            </div>
            <div class="col-md-6">
                <label class="form-label text-uppercase small">KKM License Number</label>
                <input type="text" class="form-control" name="license_no" value="{{ $clinic->license_no }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label text-uppercase small">Latitude</label>
                <input type="text" class="form-control" name="latitude" value="{{ $clinic->latitude }}">
            </div>
            <div class="col-md-4">
                <label class="form-label text-uppercase small">Longitude</label>
                <input type="text" class="form-control" name="longitude" value="{{ $clinic->longitude }}">
            </div>
            <div class="col-md-4">
                <label class="form-label text-uppercase small">Radius (meters)</label>
                <input type="number" class="form-control" name="radius" value="{{ $clinic->radius }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label text-uppercase small">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Leave blank to keep current password">
        </div>

        <div class="mb-3">
            <label class="form-label text-uppercase small">Clinic License File</label>
            <input type="file" class="form-control" name="license_file" accept=".pdf,.jpg,.jpeg,.png">
            @if($clinic->license_file)
                <small class="d-block mt-2">
                    Current file: 
                    <a href="{{ asset('storage/' . $clinic->license_file) }}" target="_blank">
                        View License
                    </a>
                </small>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label text-uppercase small">Approval Status</label>
            <select class="form-control" name="is_approved">
                <option value="0" {{ $clinic->is_approved == 0 ? 'selected' : '' }}>Pending</option>
                <option value="1" {{ $clinic->is_approved == 1 ? 'selected' : '' }}>Approved</option>
            </select>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.clinics.index') }}" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-primary">Update Clinic</button>
        </div>
    </form>

    </div>
</div>
@endsection
