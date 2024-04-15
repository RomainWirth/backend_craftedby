<?php

namespace App\Policies;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['admin', 'super-admin']) || $user->hasPermissionTo('show-orders', 'web');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Order $order): bool
    {
        $cartId = $order->cart_id;
        $cart = Cart::find('id' === $cartId);
        return $user->id === $cart->user_id || $user->hasRole(['admin', 'super-admin']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('store-order', 'web');
    }

//    /**
//     * Determine whether the user can update the model.
//     */
//    public function update(User $user, Order $order): bool
//    {
//        //
//    }
//
//    /**
//     * Determine whether the user can delete the model.
//     */
//    public function delete(User $user, Order $order): bool
//    {
//        //
//    }
//
//    /**
//     * Determine whether the user can restore the model.
//     */
//    public function restore(User $user, Order $order): bool
//    {
//        //
//    }
//
//    /**
//     * Determine whether the user can permanently delete the model.
//     */
//    public function forceDelete(User $user, Order $order): bool
//    {
//        //
//    }
}
