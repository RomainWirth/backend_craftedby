<?php

namespace Database\Factories;

use App\Models\Theme;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artisan>
 */
class ArtisanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $theme = Theme::all()->random(1)->value('id');
        $user = User::all()->random(1)->value('id');
        return [
            'siret' => fake()->unique()->numberBetween(10000000000000, 99999999999999),
            'about' => fake()->realText(500),
            'craftingDescription' => fake()->realText(250),
            'theme_id' => $theme,
            'user_id' => $user
        ];
    }
}
