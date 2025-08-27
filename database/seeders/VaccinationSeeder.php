<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example: Insert a vaccination for a pet with a specific vaccine
        $vaccine = Vaccine::first();  // Get the first vaccine (you can modify this as needed)
        $pet = Pet::first();          // Get the first pet (you can modify this as needed)

        Vaccination::create([
            'vaccine_id' => $vaccine->id,  // Link to vaccine
            'pet_id' => $pet->id,          // Link to pet
            'vaccination_date' => Carbon::now()->toDateString(), // Current date for vaccination
        ]);
        //
    }
}
