<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [
            'Boucher',
            'Boulanger',
            'Charcutier-traiteur',
            'Pâtissier',
            'Poissonnier',
            'Chocolatier-confiseur',
            'Fromager',
            'Artisan glacier',
            'Cordonnier',
            'Ébéniste',
            'Ferronnier d’art',
            'Fleuriste',
            'Sculpteur',
            'Graveur',
            'Tailleur de pierre',
            'Métallier',
            'Prothésiste dentaire',
            'Sellier-bourrelier',
            'Tapissier d’ameublement',
            'Vannier',
            'Luthier',
            'Horloger',
            'Lapidaire',
            'Diamantaire',
            'Sertisseur',
            'Céramiste',
            'Vitrailliste (maître verrier)',
            'Shaper',
            'Tonnelier',
            'Peintre en bâtiment',
            'Maître Tailleur ou Tailleur',
            'Peintre en décors',
            'Carreleur',
            'Chauffagiste',
            'Couvreur',
            'Maçon',
            'Plombier',
            'Tapissier d’ameublement',
            'Maréchal-ferrant',
            'Taxidermiste',
            'Coiffeur',
            'Esthéticienne',
            'Fleuriste',
            'Tailleur de pierre',
            'Gemmologue',
        ];

        foreach ($specialties as $specialty) {
            Specialty::create(['name' => $specialty]);
        }
    }
}
