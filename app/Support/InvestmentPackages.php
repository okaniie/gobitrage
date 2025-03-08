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
}
