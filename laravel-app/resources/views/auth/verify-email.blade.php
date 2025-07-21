@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h4>Email Verification</h4>
    <form action="{{ route('verify.email') }}" method="POST">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        
        <div class="mb-3">
            <label for="otp">Enter the verification code sent to your email:</label>
            <input type="text" name="otp" class="form-control" required>
            @error('otp') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Verify Email</button>
    </form>
</div>
@endsection
