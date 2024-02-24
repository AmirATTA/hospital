<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DoctorSurgeriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doctor_surgery')->insert([
            'doctor_id' => '1',
            'doctor_role_id' => '1',
            'surgery_id' => '1',
        ]);

        DB::table('doctor_surgery')->insert([
            'doctor_id' => '2',
            'doctor_role_id' => '2',
            'surgery_id' => '1',
        ]);
    }
}
