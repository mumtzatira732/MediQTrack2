@extends('layouts.admin')

@section('title', 'Clinics List')

@section('content')
<div class="table-responsive bg-white p-4 rounded shadow-sm">

    <div class="d-flex justify-content-between align-items-center">
        <h4>Manage Clinics</h4>
        <a href="{{ route('admin.clinics.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Add Clinic
        </a>
    </div>

    @if(session('success'))
        <br>
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Clinic Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clinics as $i => $clinic)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $clinic->clinic_name }}</td>
                    <td>{{ $clinic->email }}</td>
                    <td>
                        <a href="{{ route('admin.clinics.view', ['id' => $clinic->clinic_id]) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.clinics.edit', ['id' => $clinic->clinic_id]) }}" class="btn btn-warning btn-sm">Edit</a>

                        <!-- Delete Button -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $clinic->clinic_id }}">
                            <i class="bi bi-trash me-1"></i> Delete
                        </button>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $clinic->clinic_id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $clinic->clinic_id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 rounded-4">
                                    <form method="POST" action="{{ route('admin.clinics.delete', ['id' => $clinic->clinic_id]) }}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">

                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $clinic->clinic_id }}">Confirm Delete</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete <strong>{{ $clinic->clinic_name }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger btn-sm">Yes, Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
