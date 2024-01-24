<?php

namespace Database\Seeders;

use App\Models\Artisan;
use App\Models\Specialty;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArtisanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artisan::factory()
            ->count(4)
            ->create()
            ->each(function($artisan){
                $artisan->specialties()->attach(Specialty::all()->random(1)->pluck('id')->toArray());
                $artisan->theme()->attach(Theme::all()->random(1)->pluck('id')->toArray());
                $artisan->user()->attach(User::all()->random(1)->pluck('id')->toArray());
            });
    }
}
