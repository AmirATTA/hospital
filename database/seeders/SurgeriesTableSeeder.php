<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SurgeriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fa_IR');

        for ($i = 0; $i < 30; $i++) {
            $scenario = rand(1, 2);

            $basicInsuranceId = null;
            $suppInsuranceId = null;

            if ($scenario === 1) {
                $basicInsuranceId = rand(1, 4);
            } else {
                $suppInsuranceId = rand(5, 7);
            }

            $date = Carbon::now()->subDays($i);
            $surgery = DB::table('surgeries')->insertGetId([
                'patient_name' => $faker->name(),
                'patient_national_code' => $faker->nationalCode(),
                'basic_insurance_id' => $basicInsuranceId,
                'supp_insurance_id' => $suppInsuranceId,
                'document_number' => $faker->nationalCode(),
                'description' => $faker->paragraphs(2, true),
                'surgeried_at' => $date,
                'released_at' => $date,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            for ($x = 0; $x < rand(2,4); $x++) {
                DB::table('operation_surgery')->insert([
                    'operation_id' => rand(1,3),
                    'surgery_id' => $surgery,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }

            $roleId = 1;
            for ($z = 0; $z < 3; $z++) {
                DB::table('doctor_surgery')->insert([
                    'doctor_id' => rand(1,20),
                    'doctor_role_id' => $roleId,
                    'surgery_id' => $surgery,
                ]);
                $roleId++;
            }
        }
    }
}
