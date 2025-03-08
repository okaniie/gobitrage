<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReferralFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'referral_user_id' => rand(1, 30),
            'referral_username' => $this->faker->userName(),
            'referred_user_id' => rand(1, 30),
            'referred_username' => $this->faker->userName(),
            'referral_paid' => ['0', '1'][rand(0, 1)],
            'referral_bonus' => rand(2, 30000),
        ];
    }
}
