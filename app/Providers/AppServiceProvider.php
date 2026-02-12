<?php

namespace App\Providers;

use App\Services\ActivityLogger;
use App\Traits\FunctionsTrait;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    use FunctionsTrait;

    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('browse', function (Request $request) {
            return Limit::perMinute(2)->by($request->user());
        });

        RateLimiter::for('download', function (Request $request) {
            return Limit::perHour(1)->by($request->ip());
        });

    }
}
