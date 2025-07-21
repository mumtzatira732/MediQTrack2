<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MediQTrack</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark" style="font-family: 'Figtree', sans-serif;">

    <div class="container py-5">
        <div class="text-center mb-5">
            <img src="{{ asset('images/logo.png') }}" alt="MediQTrack Logo" style="height: 80px;">
            <h1 class="mt-3">Welcome to <strong>MediQTrack</strong></h1>
            <p class="text-muted">A Smarter Way to Manage Your Clinic Queue</p>
        </div>

        <div class="text-center mb-4">
            <a href="{{ route('patient.login') }}" class="btn btn-primary btn-lg">Go to Dashboard</a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h4 class="mb-3">Features</h4>
                        <ul class="list-unstyled text-start">
                            <li>✅ Real-time Queue Monitoring</li>
                            <li>✅ Telegram Notifications</li>
                            <li>✅ Clinic Registration with Location Detection</li>
                            <li>✅ View Clinics Nearby</li>
                        </ul>
                        <p class="mt-4 text-muted small">Laravel v{{ Illuminate\Foundation\Application::VERSION }} | PHP v{{ PHP_VERSION }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
