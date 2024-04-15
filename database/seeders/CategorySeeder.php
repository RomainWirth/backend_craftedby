<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Textile et Mode',
            'Meubles',
            'Métal',
            'Bois',
            'Céramique et Poterie',
            'Cuir',
            'Verre',
            'Pierre',
            'Bijoux',
            'Jouets',
            'Fleurs et Plantes',
            'Art Graphique',
            'Alimentaire',
            'Métiers du Bâtiment',
            'Services Artisanaux',
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
