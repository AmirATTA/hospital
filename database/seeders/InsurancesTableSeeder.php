<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InsurancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('insurances')->insert([
            'name' => 'بیمه آسماری',
            'type' => 'basic',
            'discount' => '90',
            'status' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('insurances')->insert([
            'name' => 'بیمه اتکایی ایرانیان',
            'type' => 'basic',
            'discount' => '95',
            'status' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('insurances')->insert([
            'name' => 'بیمه البرز',
            'type' => 'basic',
            'discount' => '85',
            'status' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('insurances')->insert([
            'name' => 'بیمه ایران',
            'type' => 'basic',
            'discount' => '80',
            'status' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('insurances')->insert([
            'name' => 'بیمه ایران معین',
            'type' => 'supplementary',
            'discount' => '35',
            'status' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('insurances')->insert([
            'name' => 'بیمه پارسیان',
            'type' => 'supplementary',
            'discount' => '25',
            'status' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('insurances')->insert([
            'name' => 'بیمه پارسارگاد',
            'type' => 'supplementary',
            'discount' => '50',
            'status' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
