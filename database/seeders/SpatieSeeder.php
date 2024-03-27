<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;


class SpatieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'show-users',
            'edit-user',
            'delete-user',
            'store-artisan',
            'edit-artisan',
            'delete-artisan',
//            'toggle-artisan',
            'store-specialty',
            'edit-specialty',
            'delete-specialty',
            'store-item',
            'edit-item',
            'delete-item',
            'store-category',
            'edit-category',
            'delete-category',
            'store-color',
            'edit-color',
            'delete-color',
            'store-size',
            'edit-size',
            'delete-size',
            'store-cart',
            'show-cart',
            'edit-cart',
            'delete-cart',
            'show-orders',
            'store-order',
            'change-role'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

    }
}
