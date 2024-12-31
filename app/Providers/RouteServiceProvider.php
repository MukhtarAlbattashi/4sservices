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
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware(['web', 'auth'])
                ->group(base_path('routes/vehicles/vehicle.php'));
            Route::middleware(['web', 'auth'])
                ->group(base_path('routes/vehicles/jobcard.php'));

            Route::middleware(['web', 'auth'])
                ->group(base_path('routes/services/incomesExpenses.php'));
            Route::middleware(['web', 'auth'])
                ->group(base_path('routes/services/invoices.php'));
            Route::middleware(['web', 'auth'])
                ->group(base_path('routes/services/purchases.php'));

            Route::middleware(['web', 'auth'])
                ->group(base_path('routes/hr/hr.php'));
            Route::middleware(['web', 'auth'])
                ->group(base_path('routes/hr/report.php'));
            Route::middleware(['web', 'auth'])
                ->group(base_path('routes/hr/users.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}