<?php

namespace Issetas\VacationOrange;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Nova;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::booted(function () {
            Nova::theme(asset('/issetas/vacation-orange/theme.css'));
        });

        $this->publishes([
            __DIR__.'/../resources/css' => public_path('issetas/vacation-orange'),
        ], 'public');
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
