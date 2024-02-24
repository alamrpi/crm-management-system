<?php

namespace App\Providers;

use App\Constants\Authorization\AuthGate;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define(AuthGate::CHECK_AUTH, function (User $user, $accesses) {
            if($user->role === 'admin') return true;
            return !empty(array_intersect($user->getCachedRoles(), explode( ':', $accesses)));
        });
        Paginator::useBootstrap();
    }
}
