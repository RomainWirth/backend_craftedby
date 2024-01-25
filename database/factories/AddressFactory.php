<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::all()->random(1)->value('id');
        return [
            'street' => fake()->address(),
            'postalCode' => fake()->postcode(),
            'city' => fake()->city(),
            'countryCode' => fake()->countryCode(),
            'user_id' => $userId,
        ];
    }
}
