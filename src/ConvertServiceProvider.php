<?php

namespace Starrysea\Usually;

use Illuminate\Support\ServiceProvider;

class ConvertServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Convert', function () {
            return new Convert();
        });
    }
}
