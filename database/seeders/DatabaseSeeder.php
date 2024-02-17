<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\DoctorsTableSeeder;
use Database\Seeders\SurgeriesTableSeeder;
use Database\Seeders\InsurancesTableSeeder;
use Database\Seeders\OperationsTableSeeder;
use Database\Seeders\DoctorRolesTableSeeder;
use Database\Seeders\SpecialitiesTableSeeder;
use Database\Seeders\DoctorSurgeriesTableSeeder;
use Database\Seeders\OperationSurgeriesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(InsurancesTableSeeder::class);
        $this->call(DoctorRolesTableSeeder::class);
        $this->call(OperationsTableSeeder::class);
        $this->call(SpecialitiesTableSeeder::class);
        $this->call(DoctorsTableSeeder::class);
        $this->call(SurgeriesTableSeeder::class);
        $this->call(OperationSurgeriesTableSeeder::class);
        $this->call(DoctorSurgeriesTableSeeder::class);
    }
}
