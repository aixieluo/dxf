<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Position;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
        Gate::define('order.curd', function (User $user, Order $order) {
            return $user->id === $order->user_id ||
                   in_array($user->position->name, Position::$p2);
        });

        Gate::define('admin', function (User $user) {
            return $user->position->name === Position::POSITION_ADMIN;
        });
    }
}
