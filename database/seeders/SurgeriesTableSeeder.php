<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Ybazli\Faker\Facades\Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SurgeriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('surgeries')->insert([
            'patient_name' => Faker::word('10'),
            'patient_national_code' => rand(1, 10000000000),
            'basic_insurance_id' => '1',
            'supp_insurance_id' => null,
            'document_number' => rand(10,10000000),
            'description' => Faker::sentence('10'),
            'surgeried_at' => Carbon::now(),
            'released_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
