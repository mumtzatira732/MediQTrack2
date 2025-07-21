
@extends('layouts.admin')

@section('title', 'View Clinic')

@section('content')
<div class="container mt-4">
    <div class="bg-white shadow rounded p-4">
        <h4 class="mb-4">User Details</h4>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label text-uppercase small">Name</label>
                <div class="form-control">{{ $user->name }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label text-uppercase small">Email</label>
                <div class="form-control">{{ $user->email }}</div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label text-uppercase small">Gender</label>
                <div class="form-control">{{ $user->gender }}</div>
            </div>

            <div class="col-md-6">
                <label class="form-label text-uppercase small">Phone Number</label>
                <div class="form-control">{{ $user->phone_number }}</div>
            </div>
        </div>

        <div class="row mb-1">
            <div class="col-md-3">
                <label class="form-label text-uppercase small">IC Number</label>
                <div class="form-control">{{ $user->ic_number }}</div>
            </div>
            <div class="col-md-3">
                <label class="form-label text-uppercase small">Date of Birth</label>
                <div class="form-control">{{ $user->dob }}</div>
            </div>

            <div class="col-md-6">
                <label class="form-label text-uppercase small">Password (Hashed)</label>
                <div class="form-control text-muted" style="font-size: 0.85rem">{{ $user->password }}</div>
            </div>
            
        </div>

        

        <div class="mt-4">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit User</a>
        </div>
    </div>
</div>
@endsection

