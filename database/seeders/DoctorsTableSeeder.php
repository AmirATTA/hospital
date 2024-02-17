<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Ybazli\Faker\Facades\Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialityIdIndex = 1;
        for ($i=0; $i < rand(2,10); $i++) { 
            DB::table('doctors')->insert([
                'name' => Faker::word(10),
                'national_code' => rand(1,1000000000),
                'medical_number' => rand(1,1000000000),
                'email' => 'amirmohammad.sh8326@email.com',
                'mobile' => rand(1,10000000000),
                'password' => Faker::sentence(1),
                'status' => 1,
                'speciality_id' => $specialityIdIndex,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            if($specialityIdIndex != 3) {
                $specialityIdIndex++;
            }
        }
    }
}
