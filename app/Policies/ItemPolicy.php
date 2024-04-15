<?php

namespace App\Policies;

use App\Models\Artisan;
use App\Models\Item;
use App\Models\User;

class ItemPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Artisan $artisan): bool
    {
        return $artisan->user_id === $user->id || $user->hasPermissionTo('store-item', 'web');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Artisan $artisan, Item $item): bool
    {
        return $item->artisan_id === $artisan->id || $user->hasPermissionTo('edit-item', 'web');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Artisan $artisan, Item $item): bool
    {
        return $item->artisan_id === $artisan->id || $user->hasPermissionTo('delete-item', 'web');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Item $item): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user): bool
    {
        return $user->hasRole('super-admin');
    }
}
