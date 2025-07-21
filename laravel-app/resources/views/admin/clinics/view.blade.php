@extends('layouts.admin')

@section('title', 'View Clinic')

@section('content')
<div class="bg-white shadow rounded p-4">
    <h4 class="mb-4">Clinic Details</h4>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label text-uppercase small">Clinic Name</label>
            <div class="form-control">{{ $clinic->clinic_name }}</div>
        </div>
        <div class="col-md-6">
            <label class="form-label text-uppercase small">Email</label>
            <div class="form-control">{{ $clinic->email }}</div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label text-uppercase small">Clinic Phone Number</label>
            <div class="form-control">{{ $clinic->phone }}</div>
        </div>
        <div class="col-md-6">
            <label class="form-label text-uppercase small">KKM License Number</label>
            <div class="form-control">{{ $clinic->license_no }}</div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-label text-uppercase small">Latitude</label>
            <div class="form-control">{{ $clinic->latitude }}</div>
        </div>
        <div class="col-md-4">
            <label class="form-label text-uppercase small">Longitude</label>
            <div class="form-control">{{ $clinic->longitude }}</div>
        </div>
        <div class="col-md-4">
            <label class="form-label text-uppercase small">Radius (meters)</label>
            <div class="form-control">{{ $clinic->radius }}</div>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label text-uppercase small">Password (Hashed)</label>
        <div class="form-control text-muted" style="font-size: 0.85rem">{{ $clinic->password }}</div>
    </div>

    <div class="mb-3">
        <label class="form-label text-uppercase small">Clinic License File</label>
        @if($clinic->license_file)
            <div>
                <a href="{{ asset('storage/' . $clinic->license_file) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                    View License
                </a>
            </div>
        @else
            <div class="text-muted">No license file uploaded.</div>
        @endif
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.clinics.index') }}" class="btn btn-secondary">Back</a>
        <a href="{{ route('admin.clinics.edit', $clinic->clinic_id) }}" class="btn btn-warning">Edit Clinic</a>
    </div>
</div>

@endsection
