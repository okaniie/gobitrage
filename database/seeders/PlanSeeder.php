<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\PlanCategory;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    private $plans = [
        [
            'title' => 'Basic Plan',
            'minimum' => 20,
            'maximum' => 399,
            'percentage' => 8,
            'duration' => 24,
            'duration_type' => 'hour',
            'profit_frequency' => 'end',
            'referral_percentage' => 5,
            'has_badge' => '0',
            'ordering' => 1,
            'status' => '1'
        ],
        [
            'title' => 'Standard Plan',
            'minimum' => 400,
            'maximum' => 3999,
            'percentage' => 15,
            'duration' => 48,
            'duration_type' => 'hour',
            'profit_frequency' => 'end',
            'referral_percentage' => 7,
            'has_badge' => '0',
            'ordering' => 2,
            'status' => '1'
        ],
        [
            'title' => 'Premium Plan',
            'minimum' => 4000,
            'maximum' => 7999,
            'percentage' => 20,
            'duration' => 72,
            'duration_type' => 'hour',
            'profit_frequency' => 'end',
            'referral_percentage' => 10,
            'has_badge' => '1',
            'ordering' => 3,
            'status' => '1'
        ],
        [
            'title' => 'VIP Plan',
            'minimum' => 8000,
            'maximum' => 0, // 0 means unlimited
            'percentage' => 25,
            'duration' => 76,
            'duration_type' => 'hour',
            'profit_frequency' => 'end',
            'referral_percentage' => 12,
            'has_badge' => '1',
            'ordering' => 4,
            'status' => '1'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get the Crypto Plans category
        $category = PlanCategory::where('title', 'Crypto Plans')->first();
        
        if (!$category) {
            throw new \Exception('Crypto Plans category not found. Please run PlanCategorySeeder first.');
        }

        // Create plans if they don't exist
        if (!Plan::exists()) {
            foreach ($this->plans as $plan) {
                $plan['plan_category_id'] = $category->id;
                Plan::create($plan);
            }
        }
    }
} 