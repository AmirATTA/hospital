<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            [
                'label' => 'شماره موبایل',  
                'name' => 'phone',  
                'type' => 'number',  
                'value' => '09924533026',  
                'group' => 'social',  
                'created_at' => now(),  
                'updated_at' => now(),  
            ],
            [
                'label' => 'توضیحات',  
                'name' => 'description',  
                'type' => 'text',  
                'value' => 'none',  
                'group' => 'social',  
                'created_at' => now(),  
                'updated_at' => now(),  
            ],
            [
                'label' => 'آدرس',  
                'name' => 'address',  
                'type' => 'text',  
                'value' => 'none',  
                'group' => 'social',  
                'created_at' => now(),  
                'updated_at' => now(),  
            ],
            [
                'label' => 'تصوير',  
                'name' => 'image',  
                'type' => 'image',  
                'value' => 'sister_logo_2.jpg',  
                'group' => 'social',  
                'created_at' => now(),  
                'updated_at' => now(),  
            ],


            [
                'label' => 'ارتباط با ما',  
                'name' => 'number',  
                'type' => 'number',  
                'value' => '09924533026',  
                'group' => 'general',  
                'created_at' => now(),  
                'updated_at' => now(),  
            ],
            [
                'label' => 'ايميل',  
                'name' => 'email',  
                'type' => 'email',  
                'value' => 'admin@admin.com',  
                'group' => 'general',  
                'created_at' => now(),  
                'updated_at' => now(),  
            ],
            [
                'label' => 'لوگو',  
                'name' => 'logo',  
                'type' => 'image',  
                'value' => 'sister_logo.jpg',  
                'group' => 'general',  
                'created_at' => now(),  
                'updated_at' => now(),  
            ],
        ]);
    }
}
