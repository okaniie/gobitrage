<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(2, 5),
            'username' => $this->faker->userName(),
            'currency_id' => rand(1, 5),
            'currency_code' => $this->faker->currencyCode(),
            'balance' => rand(1, 90090),
            'deposit_address' => $this->faker->uuid(),
        ];
    }
}
