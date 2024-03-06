<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fa_IR');;

        $doctorId = DB::table('doctors')->insertGetId([
            'name' => $faker->name(),
            'national_code' => $faker->nationalCode(),
            'medical_number' => $faker->nationalCode(),
            'email' => $faker->freeEmail(),
            'mobile' => rand(1, 10000000000),
            'password' => $faker->password(),
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
            'name' => $faker->name(),
            'national_code' => $faker->nationalCode(),
            'medical_number' => $faker->nationalCode(),
            'email' => $faker->freeEmail(),
            'mobile' => rand(1, 10000000000),
            'password' => $faker->password(),
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
            'name' => $faker->name(),
            'national_code' => $faker->nationalCode(),
            'medical_number' => $faker->nationalCode(),
            'email' => $faker->freeEmail(),
            'mobile' => rand(1, 10000000000),
            'password' => $faker->password(),
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
        for ($i = 0; $i < 20; $i++) {
            $doctorId = DB::table('doctors')->insertGetId([
                'name' => $faker->name(),
                'national_code' => $faker->nationalCode(),
                'medical_number' => $faker->nationalCode(),
                'email' => $faker->freeEmail(),
                'mobile' => rand(1, 10000000000),
                'password' => $faker->password(),
                'status' => 1,
                'speciality_id' => $specialityIdIndex,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            if ($specialityIdIndex != 3) {
                $specialityIdIndex++;
            }

            // Assign a role to the doctor
            for ($z = 0; $z < rand(2, 4); $z++) {
            DB::table('doctor_doctor_role')->insert([
                'doctor_id' => $doctorId,
                'doctor_role_id' => rand(1,3),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            }
        }
    }
}
