<?php

namespace Database\Seeders;

use App\Models\Vaccine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Insert vaccine data into the 'vaccines' table
        Vaccine::create([
            'name' => 'Rabies Vaccine',  // Vaccine name
        ]);

        Vaccine::create([
            'name' => 'Distemper Vaccine',
        ]);

        Vaccine::create([
            'name' => 'Bovine Tuberculosis Vaccine',
        ]);

        // Add more vaccines as needed
    }
}
