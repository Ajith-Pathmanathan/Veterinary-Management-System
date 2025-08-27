<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pet;
use Illuminate\Support\Facades\DB;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks to avoid issues when truncating
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('pets')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $pets = [
            ['type' => 'cow', 'breed' => 'Jersey', 'date_of_birth' => '2020-09-20', 'color' => 'Brown', 'gender' => 'female', 'farm_id' => 1],
            ['type' => 'goat', 'breed' => 'Boer', 'date_of_birth' => '2022-06-18', 'color' => 'White & Brown', 'gender' => 'female', 'farm_id' => 1],
            ['type' => 'cow', 'breed' => 'Holstein', 'date_of_birth' => '2020-12-10', 'color' => 'Black & White', 'gender' => 'female', 'farm_id' => 1],
            ['type' => 'goat', 'breed' => 'Nubian', 'date_of_birth' => '2023-02-20', 'color' => 'Black & Tan', 'gender' => 'male', 'farm_id' => 1],
            ['type' => 'cow', 'breed' => 'Angus', 'date_of_birth' => '2021-03-15', 'color' => 'Black', 'gender' => 'male', 'farm_id' => 1],
            ['type' => 'goat', 'breed' => 'Saanen', 'date_of_birth' => '2019-11-11', 'color' => 'White', 'gender' => 'female', 'farm_id' => 1],
            ['type' => 'other', 'breed' => 'Labrador', 'date_of_birth' => '2022-05-10', 'color' => 'Black', 'gender' => 'male', 'farm_id' => 1],
            ['type' => 'other', 'breed' => 'Siamese', 'date_of_birth' => '2021-07-15', 'color' => 'White', 'gender' => 'female', 'farm_id' => 1],
            ['type' => 'other', 'breed' => 'Arabian Horse', 'date_of_birth' => '2019-11-30', 'color' => 'Black', 'gender' => 'male', 'farm_id' => 1],
            ['type' => 'other', 'breed' => 'Holland Lop Rabbit', 'date_of_birth' => '2023-03-12', 'color' => 'Gray', 'gender' => 'female', 'farm_id' => 1],
        ];

        // Insert the data into the database
        Pet::insert($pets);
    }
}
