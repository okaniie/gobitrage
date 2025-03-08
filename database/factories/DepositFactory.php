<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DepositFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(2, 30),
            'username' => $this->faker->userName(),
            'plan_id' => rand(1, 5),
            'plan_title' => $this->faker->sentence(2),
            'transaction_id' => $this->faker->uuid(),
            'percentage' => rand(1, 100),
            'profit_frequency' => ['hourly', 'daily', 'weekly', 'monthly', 'yearly'][rand(0, 4)],
            'address' => $this->faker->uuid(),
            'amount' => rand(30, 9090009000),
            'crypto_currency' => $this->faker->currencyCode(),
            'crypto_amount' => rand(0,909090000),
            'status' => ['pending', 'approved', 'released'][rand(0, 2)],
            'approval_date' => $this->faker->date(),
        ];
    }
}
