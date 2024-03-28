<?php

namespace App\Policies;

use App\Models\Artisan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArtisanPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('store-artisan', 'web');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Artisan $artisan): bool
    {
        return $user->id === $artisan->user_id || $user->hasPermissionTo('edit-artisan', 'web');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Artisan $artisan): bool
    {
        return $user->id === $artisan->user_id || $user->hasPermissionTo('delete-artisan', 'web');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Artisan $artisan): bool
    {
        return $user->hasRole(['admin', 'super-admin']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user): bool
    {
        return $user->hasRole(['super-admin']);
    }
}
