@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <br>
    <h1 class="h3 mb-4 text-gray-800">Visit History</h1>

    @if($history->isEmpty())
        <div class="alert alert-info">No clinic visits yet.</div>
    @else
        <div class="table-responsive">
            <form method="GET" class="form-inline mb-3">
                <select name="filter" class="form-control mr-2">
                    <option value="">All Time</option>
                    <option value="today" {{ request('filter') == 'today' ? 'selected' : '' }}>Today</option>
                    <option value="week" {{ request('filter') == 'week' ? 'selected' : '' }}>Last 7 Days</option>
                    <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}>Last 30 Days</option>
                </select>

                <input type="text" name="clinic_name" class="form-control mr-2"
                    placeholder="Search Clinic Name" value="{{ request('clinic_name') }}">

                <button type="submit" class="btn btn-primary">Filter</button>
            </form>

            <table class="table table-bordered bg-white">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Queue Number</th>
                        <th>Clinic</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                   @php
                        $filteredHistory = $history->filter(function ($queue) {
                           return $queue->phase === 'completed';
                        })->values();
                    @endphp

                    @foreach($filteredHistory as $index => $queue)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $queue->queue_number }}</td>
                            <td>{{ $queue->clinic->clinic_name ?? 'N/A' }}</td>
                            <td>{{ $queue->created_at->format('d M Y h:i A') }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
