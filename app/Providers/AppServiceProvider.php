<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Responses\LoginResponse;
use App\Http\Responses\LoginViewResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Contracts\LoginViewResponse as LoginViewResponseContract;;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    $this->app->singleton(LoginResponseContract::class, LoginResponse::class);
    $this->app->singleton(LoginViewResponseContract::class, LoginViewResponse::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
