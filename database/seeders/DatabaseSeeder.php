<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

//use App\Models\Invoice;
//use App\Models\User;
//use App\Models\Zip_code;
//use Database\Factories\Zip_codeFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            PermissionsSeeder::class,
            RoleSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
            AddressSeeder::class,
            SpecialtySeeder::class,
            ThemeSeeder::class,
            ArtisanSeeder::class,
            ColorSeeder::class,
            SizeSeeder::class,
            MaterialSeeder::class,
            CategorySeeder::class,
            ItemSeeder::class,
            CartSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
