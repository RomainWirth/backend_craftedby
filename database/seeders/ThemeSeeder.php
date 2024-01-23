<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $themes = ['default', 'theme1', 'theme2'];
        foreach($themes as $theme) {
            Theme::create([
                'name' => $theme
            ]);
        }
    }
}
