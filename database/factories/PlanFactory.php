<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(2),
            'ordering' => rand(0, 6),
            'has_badge' => ['0', '1'][rand(0, 1)],
            'minimum' => rand(10, 9000),
            'maximum' => rand(0, 40),
            'percentage' => rand(1, 100),
            'referral_percentage' => rand(0, 100),
            'duration_type' => ['hour', 'day', 'week', 'month', 'year'][rand(0, 4)],
            'profit_frequency' => ['end', 'hourly', 'daily', 'weekly', 'monthly', 'yearly'][rand(0, 5)],
            'duration' => rand(2, 100),
        ];
    }
}
