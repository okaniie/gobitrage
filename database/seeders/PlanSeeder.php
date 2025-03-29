<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'plan_category_id' => 1,
                'title' => 'Starter Plan',
                'ordering' => 1,
                'has_badge' => '0',
                'minimum' => 100.00,
                'maximum' => 1000.00,
                'percentage' => 20.00,
                'referral_percentage' => 5.00,
                'duration_type' => 'day',
                'profit_frequency' => 'end',
                'duration' => 7,
                'status' => '1',
            ],
            [
                'plan_category_id' => 1,
                'title' => 'Professional Plan',
                'ordering' => 2,
                'has_badge' => '0',
                'minimum' => 1000.00,
                'maximum' => 10000.00,
                'percentage' => 35.00,
                'referral_percentage' => 5.00,
                'duration_type' => 'day',
                'profit_frequency' => 'end',
                'duration' => 7,
                'status' => '1',
            ],
            [
                'plan_category_id' => 1,
                'title' => 'Enterprise Plan',
                'ordering' => 3,
                'has_badge' => '1',
                'minimum' => 10000.00,
                'maximum' => 100000.00,
                'percentage' => 50.00,
                'referral_percentage' => 5.00,
                'duration_type' => 'day',
                'profit_frequency' => 'end',
                'duration' => 7,
                'status' => '1',
            ],
        ];

        DB::table('plans')->insert($plans);
    }
} 