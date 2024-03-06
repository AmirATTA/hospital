<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OperationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('operations')->insert([
            'name' => 'مغز',
            'price' => '20000000',
            'status' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('operations')->insert([
            'name' => 'جراحي استخوان دست',
            'price' => '5000000',
            'status' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('operations')->insert([
            'name' => 'شكستي پا',
            'price' => '125000000',
            'status' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
