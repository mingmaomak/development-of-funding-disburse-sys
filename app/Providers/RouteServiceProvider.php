<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    protected $namespace = 'App/Http/Controllers'; // got code from: https://litvinjuan.medium.com/how-to-fix-target-class-does-not-exist-in-laravel-8-f9e28b79f8b4
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->namespace($this->namespace) // got code from: https://litvinjuan.medium.com/how-to-fix-target-class-does-not-exist-in-laravel-8-f9e28b79f8b4
                ->group(base_path('routes/api.php'));

            Route::middleware('web') 
                ->namespace($this->namespace) // got code from: https://litvinjuan.medium.com/how-to-fix-target-class-does-not-exist-in-laravel-8-f9e28b79f8b4
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
