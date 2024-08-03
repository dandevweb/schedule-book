<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'    => 1,
            'name'       => $this->faker->name,
            'email'      => $this->faker->unique()->safeEmail,
            'phone'      => $this->faker->phoneNumber,
            'zip_code'   => $this->faker->postcode,
            'address'    => $this->faker->streetName,
            'number'     => $this->faker->buildingNumber,
            'complement' => $this->faker->secondaryAddress,
            'city'       => $this->faker->city,
            'state'      => $this->faker->state,
        ];
    }
}
