<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Cart\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('cart', function($app)
        {
            return new Cart(
                null,
                'cart',
                '4yTlTDKu3oJOfzD'
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
