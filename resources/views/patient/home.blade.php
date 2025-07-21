@extends('layouts.user')

@section('content')

@include('patient.alert')

<div class="container mt-4">

    {{-- Now Serving --}}
    @if($nowServing)
        <div class="text-center mb-4">
            <h5 class="text-muted">Now Serving</h5>
            <div class="display-4 fw-bold text-primary">
                {{ $nowServing->queue_number }}
            </div>
        </div>
    @endif

    @php
        $telegramLink = "https://t.me/mediqtrack_bot?start=" . auth('patient')->user()->id;
    @endphp

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    {{-- User Queue Card --}}
    @if($latestQueue && $latestQueue->status !== 'cancelled')
        <div class="card shadow mx-auto" style="max-width: 600px; border-radius: 1rem;">
            <div class="card-body px-4 py-4">
                <h5 class="mb-4 text-center display-6 fw-bold">{{ $latestQueue->queue_number }}</h5>

                <div class="mb-3"><strong>Clinic:</strong> {{ $latestQueue->clinic->clinic_name ?? 'N/A' }}</div>
                <div class="mb-3"><strong>Phase:</strong> {{ ucfirst($latestQueue->phase) }}</div>
                <div class="mb-3"><strong>Counter:</strong> {{ $latestQueue->counter_number ?? 'N/A' }}</div>
                <div class="mb-3"><strong>Now Serving:</strong> {{ $nowServing->queue_number ?? 'N/A' }}</div>
                <div class="mb-3"><strong>Created At:</strong> {{ $latestQueue->created_at->format('d M Y h:i A') }}</div>

                <form action="{{ route('patient.queue.cancel', ['id' => $latestQueue->queue_id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel?')">
                    @csrf
                    <button type="submit" class="btn btn-danger">Cancel</button>
                </form>
            </div>
        </div>

    @else
        {{-- No Queue --}}
        <div class="alert alert-info text-center">You don't have any queue yet.</div>

        {{-- Join Queue Form --}}
        <div class="card shadow mx-auto" style="max-width: 600px; border-radius: 1rem;">
            <div class="card-header text-center py-3 bg-primary text-white" style="border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                <h5 class="mb-0">Join Queue</h5>
            </div>
            <div class="card-body">

                {{-- Telegram --}}
                <div class="text-center mb-4">
                    <a href="{{ $telegramLink }}" target="_blank" class="btn btn-success rounded-pill px-4 py-2">
                        Connect Telegram
                    </a>
                </div>

                {{-- Location Form --}}
                <form method="GET" id="locationForm" action="{{ route('clinics.nearby') }}">
                    <input type="hidden" name="user_lat" id="user_lat">
                    <input type="hidden" name="user_lon" id="user_lon">
                </form>

                {{-- Klinik Form --}}
                <form method="POST" action="{{ route('patient.queue.join') }}">
                    @csrf

                    <div class="form-group">
                        <label for="clinic_id">Select Clinic</label>
                        <select name="clinic_id" id="clinic_id" class="form-control" required>
                            <option value="">-- Select Clinic --</option>
                            @foreach($clinics as $clinic)
                                <option value="{{ $clinic->clinic_id }}">{{ $clinic->clinic_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-5">Join</button>
                    </div>
                </form>

                @if($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>
    @endif
</div>

{{-- Geolocation Script --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            document.getElementById('user_lat').value = position.coords.latitude;
            document.getElementById('user_lon').value = position.coords.longitude;
            document.getElementById('locationForm').submit();
        }, function(error) {
            console.error("Location error: ", error.message);
        });
    }
});
</script>

@endsection
