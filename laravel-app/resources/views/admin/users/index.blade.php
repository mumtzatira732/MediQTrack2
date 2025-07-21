@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
<div class="table-responsive bg-white p-4 rounded shadow-sm">

    <div class="d-flex justify-content-between align-items-center">
        <h4>Manage Users</h4>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Add User
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>IC Number</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $i => $user)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->ic_number }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('admin.users.view', $user->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <!-- Delete Button -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                            <i class="bi bi-trash me-1"></i> Delete
                        </button>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 rounded-4">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Confirm Delete</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete <strong>{{ $user->name }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" action="{{ route('admin.users.delete', $user->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger btn-sm">Yes, Delete</button>
                                        </form>
                                    </div>
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
