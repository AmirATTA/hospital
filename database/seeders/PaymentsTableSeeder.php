<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payments')->insert([
            'invoice_id' => 1,
            'amount' => '10000000',
            'pay_type' => 'cheque',
            'due_date' => Carbon::now(),
            'receipt' => null,
            'description' => null,
            'status' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 

        DB::table('payments')->insert([
            'invoice_id' => 1,
            'amount' => '5000000',
            'pay_type' => 'cash',
            'due_date' => null,
            'receipt' => null,
            'description' => null,
            'status' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 

        DB::table('payments')->insert([
            'invoice_id' => 1,
            'amount' => '2000000',
            'pay_type' => 'cash',
            'due_date' => null,
            'receipt' => null,
            'description' => null,
            'status' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 

        DB::table('payments')->insert([
            'invoice_id' => 1,
            'amount' => '1500000',
            'pay_type' => 'cheque',
            'due_date' => Carbon::now(),
            'receipt' => null,
            'description' => null,
            'status' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 
    }
}
