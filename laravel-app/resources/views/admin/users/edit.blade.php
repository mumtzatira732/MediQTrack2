@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="container mt-4">
    <div class="bg-white shadow rounded p-4">
        <h4 class="mb-4">Edit User</h4>

        <form method="POST" action="{{ route('admin.users.update', ['id' => $user->id]) }}">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label text-uppercase small">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-uppercase small">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label text-uppercase small">Gender</label>
                    <select class="form-control" name="gender">
                        <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-uppercase small">Phone Number</label>
                    <input type="number" class="form-control" name="phone_number" value="{{ $user->phone_number }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label text-uppercase small">IC Number</label>
                    <input type="text" class="form-control" name="ic_number" value="{{ $user->ic_number }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label text-uppercase small">Date of Birth</label>
                    <input type="text" class="form-control" name="dob" value="{{ $user->dob }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label text-uppercase small">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Leave blank to keep current password">
                </div>
            </div>

            
            <div class="mt-4">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Update User</button>
            </div>
        </form>
    </div>
</div>
@endsection

