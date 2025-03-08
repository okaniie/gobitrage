<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
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
            'username' =>  $this->faker->userName(),
            'log_type' =>  ['withdrawal', 'deposit', 'deposit-release', ''][rand(0, 2)],
            'transaction_id' =>  $this->faker->uuid(),
            'transaction_details' =>  $this->faker->sentence(),
            'crypto_currency' =>  $this->faker->currencyCode(),
            'amount' =>  rand(0, 9090009),
        ];
    }
}
