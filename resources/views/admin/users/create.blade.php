@extends('layouts.admin')

@section('title', 'Add User')

@section('content')
<div class="container mt-4">
    <div class="bg-white shadow p-4 rounded">
        <h4 class="mb-4">Add New User</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-control" required>
                    <option value="" disabled selected>-- Select Gender --</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">IC Number</label>
                <input type="text" name="ic_number" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dob" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone_number" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="text-end">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
                <button type="submit" class="btn btn-success btn-sm">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
