<?php

namespace App\Providers;

use App\Models\Users;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Html\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

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
        //
        Builder::useVite();
        Paginator::useBootstrapFive();

        Gate::define('isRt', function (Users $user) {
            return $user->role === 'RT';
        });

        Gate::define('isRw', function (Users $user) {
            return $user->role === 'RW';
        });

        // old
        // if (app()->isProduction()) {
        //     URL::forceRootUrl(config('app.url'));
        //     URL::forceScheme('https');
        // }

        // new
        if (env('APP_ENV') === 'production') {
            $this->app['request']->server->set('HTTPS', 'on');
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
