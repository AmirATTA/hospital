<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < rand(25,75); $i++) { 
            DB::table('articles')->insert([
                'title' => Faker::word(10),
                'slug' => Str::slug(Faker::sentence(10)),
                'summary' => Faker::sentence(2),
                'body' => Faker::paragraph(25),
                'image' => rand(1,8) . '.jpg',
                'views_count' => rand(0,1000),
                'resource_label' => Faker::sentence(1),
                'resource_url' => 'www.youtube.com',
                'category_id' => rand(1,5),
                'user_id' => 1,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
