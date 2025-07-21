@extends('layouts.guest')

@section('content')
<div class="container mt-5">
    <h3>Enter Your OTP</h3>
    <form method="POST" action="{{ route('patient.verify-otp.submit', ['id' => $id]) }}">

        @csrf

        <input type="hidden" name="email" value="{{ $email }}">

        <div class="mb-3">
            <label for="otp" class="form-label">OTP Code</label>
            <input type="text" name="otp" id="otp" class="form-control" maxlength="6" required>
        </div>

        @if($errors->has('otp'))
            <div class="text-danger">{{ $errors->first('otp') }}</div>
        @endif

        <button type="submit" class="btn btn-primary">Verify</button>
    </form>
</div>
@endsection
