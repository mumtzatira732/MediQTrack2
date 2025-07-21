<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            PatientSeeder::class,
            ClinicSeeder::class,
            CounterSeeder::class,
            QueueSeeder::class, // LAST, depends on the above
        ]);
    }
}
