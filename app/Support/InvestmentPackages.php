<?php

namespace App\Support;

use App\Models\Plan;
use App\Models\PlanCategory;

class InvestmentPackages
{
    public static function getInvestmentPackages()
    {
        $categories = PlanCategory::orderBy('ordering')->get()->all();
        foreach ($categories as $category) {
            $category->plans = Plan::where('plan_category_id', $category->id)->get();
        }

        return $categories;
    }

    public static function getPackages()
    {
        return [
            'basic' => [
                'name' => 'Basic Plan',
                'min_amount' => 20,
                'max_amount' => 1999,
                'profit_percentage' => 8,
                'duration_hours' => 24,
                'referral_percentage' => 5,
                'category' => 'starter',
                'icon' => 'bi bi-piggy-bank',
            ],
            'premium' => [
                'name' => 'Premium Plan',
                'min_amount' => 2000,
                'max_amount' => 5999,
                'profit_percentage' => 20,
                'duration_hours' => 72,
                'referral_percentage' => 10,
                'category' => 'premium',
                'icon' => 'bi bi-diamond-fill',
                'featured' => true,
            ],
            'vip' => [
                'name' => 'VIP Plan',
                'min_amount' => 6000,
                'max_amount' => 9999,
                'profit_percentage' => 25,
                'duration_hours' => 76,
                'referral_percentage' => 12,
                'category' => 'vip',
                'icon' => 'bi bi-trophy',
                'featured' => true,
            ],
            'elite' => [
                'name' => 'Elite Plan',
                'min_amount' => 10000,
                'max_amount' => null,
                'profit_percentage' => 30,
                'duration_hours' => 96,
                'referral_percentage' => 15,
                'category' => 'elite',
                'icon' => 'bi bi-crown',
                'featured' => true,
            ],
        ];
    }
}
