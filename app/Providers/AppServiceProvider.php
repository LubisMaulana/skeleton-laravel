<?php
namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('opr', function (User $user) {
            return $user->role === 'OPR';
        });

        Gate::define('spv', function (User $user) {
            return $user->role === 'SPV';
        });
    }
}
