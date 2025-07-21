<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Clinic extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'clinic_id';

    protected $fillable = [
        'clinic_name',
        'email',
        'latitude',
        'longitude',
        'radius',
        'password',
        'is_approved',
        'phone',
        'license_no',
        'license_file',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
