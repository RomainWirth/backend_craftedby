<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rating' => fake()->numberBetween(0, 5),
            'comment' => fake()->text(500),
            'user_id' => User::all()->random(1)->value('id'),
            'item_id' => Item::all()->random(1)->value('id')
        ];
    }
}
