@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid mt-4">
    <div class="row g-4">
        <!-- Total Patients -->
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5 class="card-title">Total Patients</h5>
                    <p class="fs-3 fw-bold">{{ $totalPatients }}</p>
                </div>
            </div>
        </div>

        <!-- Total Clinics -->
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5 class="card-title">Total Clinics</h5>
                    <p class="fs-3 fw-bold">{{ $totalClinics }}</p>
                </div>
            </div>
        </div>

        <!-- Today's Queues -->
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5 class="card-title">Today's Queues</h5>
                    <p class="fs-3 fw-bold">{{ $todayQueues }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-3">
        <!-- Active Phase Queues -->
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5 class="card-title">Consultation Ongoing</h5>
                    <p class="fs-3 fw-bold">{{ $consultationPhase }}</p>
                </div>
            </div>
        </div>

        <!-- Pharmacy Phase Queues -->
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5 class="card-title">Pharmacy Phase</h5>
                    <p class="fs-3 fw-bold">{{ $pharmacyPhase }}</p>
                </div>
            </div>
        </div>

        <!-- Completed Queues -->
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5 class="card-title">Completed Queues</h5>
                    <p class="fs-3 fw-bold">{{ $completedPhase }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
