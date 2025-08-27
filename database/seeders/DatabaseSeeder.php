<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RoleSeeder::class,
        ]);

        $this->call(FarmsTableSeeder::class);
        $this->call([
            VaccineSeeder::class,
        ]);
        $this->call([
            VaccinationSeeder::class,  // Call your vaccination seeder here
        ]);

        // User::factory(10)->create();


    }
}
