@extends('layouts.patient')

@section('title', 'Patient Home')

@section('content')
    <h2>Welcome, {{ Auth::guard('patient')->user()->name }}</h2>
    <p>You are successfully logged in as a patient.</p>
@endsection
