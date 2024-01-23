<?php

namespace Database\Factories;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cart = Cart::all()->random(1)->value('id');
        return [
            'sendStatus' => fake()->boolean('false'),
            'totalPrice' => fake()->randomNumber(2),
            'cart_id' => $cart

        ];
    }
}
