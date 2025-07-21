@extends('layouts.guest')

@section('title', 'Verify OTP')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3>Enter OTP Code</h3>

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('patient.otp.verify', $patient->id) }}">
                @csrf
                <div class="mb-3">
                    <label for="otp" class="form-label">OTP Code</label>
                    <input type="text" name="otp" class="form-control" required maxlength="6">
                </div>
                <button type="submit" class="btn btn-primary w-100">Verify</button>
            </form>
        </div>
    </div>
</div>
@endsection
