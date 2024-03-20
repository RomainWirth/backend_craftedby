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
        $adminRole = Role::create(['name' => 'admin']);
        $artisanRole = Role::create(['name' => 'artisan']);
        $userRole = Role::create(['name' => 'user']);

        $manageUsersPermission = Permission::create(['name' => 'manage users']);
        $createUserPermission = Permission::create(['name' => 'create user']);
        $updateUserPermission = Permission::create(['name' => 'update user']);
        $deleteUserPermission = Permission::create(['name' => 'delete user']);

        $manageArtisansPermission = Permission::create(['name' => 'manage artisans']);
        $createArtisanPermission = Permission::create(['name' => 'create artisan']);
        $updateArtisanPermission = Permission::create(['name' => 'update artisan']);
        $deleteArtisanPermission = Permission::create(['name' => 'delete artisan']);

        $createItemPermission = Permission::create(['name' => 'create item']);
        $updateItemPermission = Permission::create(['name' => 'update item']);
        $deleteItemPermission = Permission::create(['name' => 'delete item']);

        $createCartPermission = Permission::create(['name' => 'create cart']);
        $updateCartPermission = Permission::create(['name' => 'update cart']);
        $deleteCartPermission = Permission::create(['name' => 'delete cart']);

        $manageOrdersPermission = Permission::create(['name' => 'manage orders']);
        $createOrderPermission = Permission::create(['name' => 'create order']);

        $clientPermission = [

        ];

        $artisanPermission = [

        ];

        $adminPermissions = [
            $manageUsersPermission,
            $manageArtisansPermission,
            $manageOrdersPermission
        ];

        $adminRole->givePermissionTo('all');
    }
}
