<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ActivityLogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $y = 1;
        for ($i = 0; $i < 11; $i++) {
            DB::table('activity_log')->insert([
                'log_name' => 'default',
                'description' => 'جراحی ایجاد شد',
                'event' => 'created',
                'subject_type' => 'App\Models\Surgery',
                'causer_type' => 'App\Models\Users',
                'causer_id' => '1',
                'properties' => null,
                'batch_uuid' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $y++;
        }
    }
}
