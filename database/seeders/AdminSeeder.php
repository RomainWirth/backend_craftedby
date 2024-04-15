<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'firstname' => 'Admin',
            'lastname' => 'ADMIN',
            'email' => 'wirth.romain@gmail.com',
            'password' => Hash::make('RomAdmin!'),
        ]);
        $superAdmin->assignRole('super-admin');
    }
}
