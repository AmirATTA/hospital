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
        $doctorId = DB::table('doctors')->insertGetId([
            'name' => Faker::word(10),
            'national_code' => rand(1, 1000000000),
            'medical_number' => rand(1, 1000000000),
            'email' => 'amirmohammad.sh8326@email.com',
            'mobile' => rand(1, 10000000000),
            'password' => Faker::sentence(1),
            'status' => 1,
            'speciality_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('doctor_doctor_role')->insert([
            'doctor_id' => 1,
            'doctor_role_id' => rand(1,3),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        $doctorId = DB::table('doctors')->insertGetId([
            'name' => Faker::word(10),
            'national_code' => rand(1, 1000000000),
            'medical_number' => rand(1, 1000000000),
            'email' => 'amirmohammad.sh8326@email.com',
            'mobile' => rand(1, 10000000000),
            'password' => Faker::sentence(1),
            'status' => 1,
            'speciality_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('doctor_doctor_role')->insert([
            'doctor_id' => 2,
            'doctor_role_id' => rand(1,3),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        $doctorId = DB::table('doctors')->insertGetId([
            'name' => Faker::word(10),
            'national_code' => rand(1, 1000000000),
            'medical_number' => rand(1, 1000000000),
            'email' => 'amirmohammad.sh8326@email.com',
            'mobile' => rand(1, 10000000000),
            'password' => Faker::sentence(1),
            'status' => 1,
            'speciality_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('doctor_doctor_role')->insert([
            'doctor_id' => 3,
            'doctor_role_id' => rand(1,3),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $specialityIdIndex = 1;
        $randValue = rand(3,10);
        for ($i = 0; $i < $randValue; $i++) {
            $doctorId = DB::table('doctors')->insertGetId([
                'name' => Faker::word(10),
                'national_code' => rand(1, 1000000000),
                'medical_number' => rand(1, 1000000000),
                'email' => 'amirmohammad.sh8326@email.com',
                'mobile' => rand(1, 10000000000),
                'password' => Faker::sentence(1),
                'status' => 1,
                'speciality_id' => $specialityIdIndex,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            if ($specialityIdIndex != 3) {
                $specialityIdIndex++;
            }

            // Assign a role to the doctor
            DB::table('doctor_doctor_role')->insert([
                'doctor_id' => $doctorId,
                'doctor_role_id' => rand(1,3),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
