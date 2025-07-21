@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Email Verification</h1>
    <p>Please check your email for a verification link.</p>

    <form method="POST" action="{{ route('patient.verification.send') }}">
        @csrf
        <button type="submit">Resend Email</button>
    </form>

    @if (session('message'))
        <p>{{ session('message') }}</p>
    @endif
</div>
@endsection
