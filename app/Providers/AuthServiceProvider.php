<?php

namespace App\Providers;

use App\Models\Artisan;
use App\Models\Cart;
use App\Models\Color;
use App\Models\Item;
use App\Models\Material;
use App\Models\Order;
use App\Models\Role;
use App\Models\Size;
use App\Models\Specialty;
use App\Models\Theme;
use App\Models\User;
use App\Policies\ArtisanPolicy;
use App\Policies\CartPolicy;
use App\Policies\ColorPolicy;
use App\Policies\ItemPolicy;
use App\Policies\MaterialPolicy;
use App\Policies\OrderPolicy;
use App\Policies\RolePolicy;
use App\Policies\SizePolicy;
use App\Policies\SpecialtyPolicy;
use App\Policies\ThemePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Artisan::class => ArtisanPolicy::class,
        Item::class => ItemPolicy::class,
        Cart::class => CartPolicy::class,
        Order::class => OrderPolicy::class,

        Theme::class => ThemePolicy::class,
        Specialty::class => SpecialtyPolicy::class,
        Material::class => MaterialPolicy::class,
        Color::class => ColorPolicy::class,
        Size::class => SizePolicy::class,

        Role::class => RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super-admin') ? true : null;
        });
    }
}
