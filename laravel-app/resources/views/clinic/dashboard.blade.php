@extends('layouts.clinic')

@section('content')
<div class="container mt-5">
    {{-- Welcome + Summary Card --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Welcome, {{ Auth::guard('clinic')->user()->clinic_name }}</h5>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-md-4">
                    <div class="alert alert-info">
                        <strong>Total Queues:</strong> {{ $queues->count() }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-warning">
                        <strong>Active Consultation:</strong> {{ $queues->where('phase', 'consultation')->count() }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-success">
                        <strong>Completed Today:</strong> {{ $queues->where('phase', 'completed')->count() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Auto-Assign Button + Flash Messages --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('clinic.autoAssignAll') }}" class="mb-3">
        @csrf
        <button class="btn btn-primary">
            Assign Patients
        </button>
    </form>

    {{-- Queue Management Table --}}
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h6 class="mb-0">Queue Management</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Patient Name</th>
                        <th>Phase</th>
                        <th>Status</th>
                        <th>Counter</th>
                        <th>Joined At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($queues as $index => $queue)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $queue->patient->name }}</td>
                            <td>{{ ucfirst($queue->phase) }}</td>
                            <td>
                                @if ($queue->status === 'cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                @elseif ($queue->phase === 'consultation')
                                    <span class="badge bg-warning text-dark">In Consultation</span>
                                @elseif ($queue->phase === 'pharmacy')
                                    <span class="badge bg-info text-dark">At Pharmacy</span>
                                @elseif ($queue->phase === 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @else
                                    <span class="badge bg-secondary">Waiting</span>
                                @endif
                            </td>
                            <td>
                                {{ $queue->counter_number ?? '-' }}
                            </td>
                            <td>{{ $queue->created_at->format('d M Y, h:i A') }}</td>
                           <td>
    @if ($queue->status === 'cancelled')
        <span class="text-muted">-</span>
    @elseif ($queue->phase === 'consultation')
        <form method="POST" action="{{ route('clinic.queue.update', $queue->queue_id) }}">
    <input type="hidden" name="next_phase" value="pharmacy">

            @csrf
            <button class="btn btn-sm btn-warning">To Pharmacy</button>
        </form>
    @elseif ($queue->phase === 'pharmacy')
        <form method="POST" action="{{ route('clinic.queue.done', $queue->queue_id) }}">
            @csrf
            <button class="btn btn-sm btn-success">Mark as Done</button>
        </form>
    @else
        <span class="text-muted">-</span>
    @endif
</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No queues yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
