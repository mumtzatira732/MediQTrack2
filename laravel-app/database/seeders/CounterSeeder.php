<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Counter;

class CounterSeeder extends Seeder
{
    public function run(): void
    {
        Counter::create([
            'counter_name' => 'Counter A',
            'status' => 'open',
            'clinic_id' => 1,
        ]);

        Counter::create([
            'counter_name' => 'Counter B',
            'status' => 'closed',
            'clinic_id' => 1,
        ]);

        Counter::create([
            'counter_name' => 'Counter C',
            'status' => 'open',
            'clinic_id' => 2,
        ]);
    }
}