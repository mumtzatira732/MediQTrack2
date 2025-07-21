<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;

    protected $primaryKey = 'counter_id';

    protected $fillable = [
        'counter_name',
        'status',
        'clinic_id',
    ];
}