<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WithdrawalFactory extends Factory
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
            'amount' => rand(1, 9900989),
            'crypto_currency' => $this->faker->currencyCode(),
            'address' => $this->faker->uuid(),
            'status' => ['pending', 'completed', 'cancelled'][rand(0, 2)],
            'message_from_user' => $this->faker->sentence(),
            'message_from_admin' =>$this->faker->sentence(),
        ];
    }
}
