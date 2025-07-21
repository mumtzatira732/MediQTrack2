@extends('layouts.admin')

@section('title', 'Pending Clinic Approvals')

@section('content')
<div class="table-responsive bg-white p-4 rounded shadow-sm">
    <h4>Pending Clinic Approvals</h4>

    <br>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Clinic Name</th>
                <th>Email</th>
                <th>License No</th>
                <th>License File</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clinics as $i => $clinic)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $clinic->clinic_name }}</td>
                    <td>{{ $clinic->email }}</td>
                    <td>{{ $clinic->license_no ?? '-' }}</td>
                    <td>
                        @if($clinic->license_file)
                            <a href="{{ asset('storage/' . $clinic->license_file) }}" target="_blank">View File</a>
                        @else
                            <span class="text-muted">No File</span>
                        @endif
                    </td>
                    <td class="d-flex gap-1">
                        <form action="{{ route('admin.clinics.approve', $clinic->clinic_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-success btn-sm">Approve</button>
                        </form>
                        <form action="{{ route('admin.clinics.reject', $clinic->clinic_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No pending clinics found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
