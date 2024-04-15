<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            'Bois - Chêne',
            'Bois - Pin',
            'Bois - Acajou',
            'Bois - Teck',
            'Bois - Contreplaqué',
            'Métal - Acier',
            'Métal - Aluminium',
            'Métal - Cuivre',
            'Métal - Bronze',
            'Métal - Laiton',
            'Métal - Fer forgé',
            'Plastique - Polyéthylène',
            'Plastique - Polypropylène',
            'Plastique - PVC',
            'Plastique - ABS',
            'Plastique - Polystyrène',
            'Verre - Verre ordinaire',
            'Verre - Pyrex',
            'Verre - Plexiglas',
            'Verre - Verre trempé',
            'Céramique - Porcelaine',
            'Céramique - Faïence',
            'Céramique - Terre cuite',
            'Céramique - Grès',
            'Textiles - Coton',
            'Textiles - Lin',
            'Textiles - Soie',
            'Textiles - Laine',
            'Caoutchouc - Caoutchouc naturel',
            'Caoutchouc - Caoutchouc synthétique',
            'Caoutchouc - Néoprène',
            'Caoutchouc - Silicone',
            'Pierre - Marbre',
            'Pierre - Granit',
            'Pierre - Calcaire',
            'Pierre - Ardoise',
            'Composites - Fibre de verre',
            'Composites - Fibre de carbone',
            'Matières naturelles - Bambou',
            'Matières naturelles - Liège',
            'Matières naturelles - Chanvre',
            'Matières naturelles - Jute',
            'Matières naturelles - Cuir',
            'Matières naturelles - Peau d\'animal',
            'Matières recyclées - Matériaux recyclés plastiques',
            'Matières recyclées - Matériaux recyclés en papier',
            'Matières recyclées - Matériaux recyclés en métal',
        ];

        foreach ($materials as $material) {
            Material::create(['name' => $material]);
        }
    }
}
