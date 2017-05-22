<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		\View::share('approotkey', 'ni ya shi kakaxi');

		$this->app->when(\App\Http\Controllers\HomeController::class)
            ->needs('sami')
            ->give("daughter");
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
