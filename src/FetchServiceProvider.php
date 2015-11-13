<?php

namespace NB\Utilities\Fetch;

use Illuminate\Support\ServiceProvider;

class FetchServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('fetch', function ($app) {
            return new FetchHelper();
        });
    }
}
