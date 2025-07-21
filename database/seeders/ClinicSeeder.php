<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Clinic;
use Illuminate\Support\Facades\Hash;

class ClinicSeeder extends Seeder
{
    

public function run(): void
    {
        Clinic::create([
            'clinic_name' => 'Klinik ABC',
            'email' => 'abc@example.com',
            'password' => Hash::make('123456'),
            'latitude' => 2.2000000,
            'longitude' => 102.2500000,
            'radius' => 5.0
        ]);

        Clinic::create([
            'clinic_name' => 'Klinik XYZ',
            'email' => 'xyz@example.com',
            'password' => Hash::make('abcdef'),
            'latitude' => 2.2100000,
            'longitude' => 102.2600000,
            'radius' => 4.5
        ]);
    }

}
