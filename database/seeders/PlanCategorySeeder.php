<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlanCategorySeeder extends Seeder
{
    private $plan_categories = [
        ['title' => 'Crypto Plans', 'description' => 'Crypto Currency Investment Plans'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // plan categories
        if (!\App\Models\PlanCategory::exists()) {
            foreach ($this->plan_categories as $pcategory) {
                \App\Models\PlanCategory::create($pcategory);
            }
        }
    }
}
