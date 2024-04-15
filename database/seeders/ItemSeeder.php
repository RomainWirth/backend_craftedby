<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Item;
use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::factory()
            ->count(20)
            ->create()
            ->each(function($item){
                $item->materials()->attach(Material::all()->random(1));
            });
    }
}
