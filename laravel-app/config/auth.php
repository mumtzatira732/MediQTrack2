<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'clinic' => [
            'driver' => 'session',
            'provider' => 'clinics',
        ],

        'patient' => [
            'driver' => 'session',
            'provider' => 'patients',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'clinics' => [
            'driver' => 'eloquent',
            'model' => App\Models\Clinic::class,
        ],

        'patients' => [
            'driver' => 'eloquent',
            'model' => App\Models\Patient::class,
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        'clinics' => [
            'provider' => 'clinics',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        'patients' => [
            'provider' => 'patients',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
