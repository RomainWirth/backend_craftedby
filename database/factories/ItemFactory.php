<?php

namespace Database\Factories;

use App\Models\Artisan;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::all()->random(1)->value('id');
        $size = Size::all()->random(1)->value('id');
        $color = Color::all()->random(1)->value('id');
        $artisan = Artisan::all()->random(1)->value('id');
        return [
            'name' => fake()->unique()->text(50),
            'imageUrl' => fake()->imageUrl(),
            'description' => fake()->text(500),
            'price' => fake()->randomNumber(4),
            'stock' => fake()->randomNumber(2),
            'category_id' => $category,
            'size_id' => $size,
            'color_id' => $color,
            'artisan_id' => $artisan
        ];
    }
}
