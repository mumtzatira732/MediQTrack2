<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        Patient::create([
            'name' => 'Ali Bin Ahmad',
            'ic_number' => '990101-14-1234',
            'dob' => '1999-01-01',
            'email' => 'ali@example.com',
            'phone_number' => '0123456789',
            'gender' => 'Male',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
        ]);

        Patient::create([
            'name' => 'Siti Aminah',
            'ic_number' => '980202-10-5678',
            'dob' => '1998-02-02',
            'email' => 'siti@example.com',
            'phone_number' => '0198765432',
            'gender' => 'Female',
            'email_verified_at' => now(),
            'password' => Hash::make('siti12345'),
        ]);
    }
}
