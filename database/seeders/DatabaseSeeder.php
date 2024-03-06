<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\DoctorsTableSeeder;
use Database\Seeders\PaymentsTableSeeder;
use Database\Seeders\SettingsTableSeeder;
use Database\Seeders\SurgeriesTableSeeder;
use Database\Seeders\InsurancesTableSeeder;
use Database\Seeders\OperationsTableSeeder;
use Database\Seeders\DoctorRolesTableSeeder;
use Database\Seeders\SpecialitiesTableSeeder;

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
        $this->call(SettingsTableSeeder::class);
        $this->call(PaymentsTableSeeder::class);
    }
}
