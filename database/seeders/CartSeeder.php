<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cart::factory()
            ->count(5)
            ->create()
            ->each( function($cart) {
                $cart->items()->attach(
                    Item::all()->random(1)->pluck('id'),
                    ['quantity' => Item::all()->random(1)->pluck('stock')[0]]
                );
            });
    }
}
