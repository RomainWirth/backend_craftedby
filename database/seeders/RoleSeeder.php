<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::create(['name' => 'super-admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::create(['name' => 'admin']);
        $artisan = Role::create(['name' => 'artisan']);
        $customer = Role::create(['name' => 'user']);

        $admin->givePermissionTo([
            'show-users',
            'edit-user',
            'delete-user',
            'store-specialty',
            'edit-specialty',
            'delete-specialty',
            'store-category',
            'edit-category',
            'delete-category',
            'store-color',
            'edit-color',
            'delete-color',
            'store-size',
            'edit-size',
            'delete-size',
            'change-role',
            'store-cart',
            'show-cart',
            'edit-cart',
            'delete-cart',
            'show-orders',
            'store-order',
        ]);

        $artisan->givePermissionTo([
            'edit-user',
            'delete-user',
            'edit-artisan',
            'delete-artisan',
            'store-item',
            'edit-item',
            'delete-item',
            'store-cart',
            'show-cart',
            'edit-cart',
            'delete-cart',
            'show-orders',
            'store-order',
        ]);

        $customer->givePermissionTo([
            'edit-user',
            'delete-user',
            'store-artisan',
            'store-cart',
            'show-cart',
            'edit-cart',
            'delete-cart',
            'show-orders',
            'store-order',
        ]);
    }
}
