<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Queue;
use Carbon\Carbon;

class QueueSeeder extends Seeder
{
    public function run(): void
    {
        Queue::insert([
            [
                'queue_number' => 'Q169',
                
                'phase' => 'completed',
                'patient_id' => 1,
                'clinic_id' => 2,
                'counter_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'queue_number' => 'Q843',
               
                'phase' => 'consultation',
                'patient_id' => 2,
                'clinic_id' => 2,
                'counter_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'queue_number' => 'Q800',
                
                'phase' => 'completed',
                'patient_id' => 2,
                'clinic_id' => 2,
                'counter_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'queue_number' => 'Q279',
                
                'phase' => 'completed',
                'patient_id' => 2,
                'clinic_id' => 2,
                'counter_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'queue_number' => 'Q580',
                
                'phase' => 'completed',
                'patient_id' => 2,
                'clinic_id' => 1,
                'counter_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
