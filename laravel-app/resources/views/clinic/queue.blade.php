<!-- resources/views/clinic/queue.blade.php -->
@extends('layouts.guest')

@section('content')
<section class="container py-5">
    <h2 class="mb-4">Queue Management</h2>

    <div class="card shadow rounded p-4">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Patient Name</th>
                    <th>Queue Number</th>
                    <th>Phase</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($queues as $queue)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $queue->patient_name }}</td>
                    <td>{{ $queue->queue_number }}</td>
                    <td>
                        @if ($queue->phase === 'consultation')
                            <span class="badge bg-warning">Consultation</span>
                        @elseif ($queue->phase === 'pharmacy')
                            <span class="badge bg-info">Pharmacy</span>
                        @else
                            <span class="badge bg-success">Completed</span>
                        @endif
                    </td>
                    <td>{{ ucfirst($queue->status) }}</td>
                    <td>
                        @if ($queue->phase === 'consultation')
                            <form method="POST" action="{{ route('clinic.queue.update', $queue->id) }}">
                                @csrf
                                <input type="hidden" name="next_phase" value="pharmacy">
                                <button class="btn btn-sm btn-primary">Complete Consultation</button>
                            </form>
                        @elseif ($queue->phase === 'pharmacy')
                            <form method="POST" action="{{ route('clinic.queue.update', $queue->id) }}">
                                @csrf
                                <input type="hidden" name="next_phase" value="completed">
                                <button class="btn btn-sm btn-success">Complete Pharmacy</button>
                            </form>
                        @else
                            <span class="text-muted">Done</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection