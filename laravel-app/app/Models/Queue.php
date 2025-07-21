<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $table = 'queues'; // use your actual table name

    protected $primaryKey = 'queue_id'; // if your PK is queue_id

    protected $fillable = [
        'queue_number',
        'status',
        'patient_id',
        'clinic_id',
        'counter_id',
        'phase',
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id', 'clinic_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
}
