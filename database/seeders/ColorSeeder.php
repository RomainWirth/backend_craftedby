<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            'Blanc',
            'Noir',
            'Gris',
            'Rouge',
            'Bleu',
            'Vert',
            'Jaune',
            'Orange',
            'Rose',
            'Violet',
            'Marron',
            'Beige',
            'Turquoise',
            'Indigo',
            'Cyan',
            'Magenta',
            'Or',
            'Argent',
            'Bronze',
            'Lavande',
            'Corail',
            'Olive',
            'Saumon',
            'Pêche',
            'Aqua',
            'Émeraude',
            'Bordeaux',
            'Mauve',
            'Sable',
            'Charbon',
        ];

        foreach ($colors as $color) {
            Color::create(['name' => $color]);
        }
    }
}
