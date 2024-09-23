<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('admin', function (User $user) {
            return $user->profile === 'admin' ? true : false;
        });
        Gate::define('loja', function (User $user) {
            return $user->profile === 'loja' ? true : false;
        });
        Gate::define('vendedor', function (User $user) {
            return $user->profile === 'vendedor' ? true : false;
        });
    }
}
