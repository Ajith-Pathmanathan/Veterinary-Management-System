<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Farm; // Import the Farm model
use Illuminate\Support\Facades\DB;

class FarmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // Create 20 fake farm records
        foreach (range(1, 20) as $index) {
            Farm::create([
                'user_id' => 1, // Assuming there are at least 10 users
                'name' => $faker->company,
                'size' => $faker->randomFloat(2, 1, 100), // Size between 1 and 100 acres
                'type' => $faker->randomElement(['Dairy', 'Poultry', 'Crop', 'Mixed']),
                'street' => $faker->streetAddress,
                'city' => $faker->city,
                'district' => $faker->randomElement([
                    'Jaffna', 'Kilinochchi', 'Mannar', 'Mullaitivu', 'Vavuniya',
                ]),

            ]);
        }
    }
}
