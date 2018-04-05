<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\OrderController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(OrderController $order)
    {
        //
        View::share('countOrder', $order->countOrder());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Http\Controllers\Contracts\CategoryInterface',
            'App\Http\Controllers\Repositories\CategoryRepository'
        );
        $this->app->bind(
            'App\Http\Controllers\Contracts\ImageInterface',
            'App\Http\Controllers\Repositories\ImageRepository'
        );
        $this->app->bind(
            'App\Http\Controllers\Contracts\SeoInterface',
            'App\Http\Controllers\Repositories\SeoRepository'
        );
        $this->app->bind(
            'App\Http\Controllers\Contracts\ItemsInterface',
            'App\Http\Controllers\Repositories\ItemsRepository'
        );
        $this->app->bind(
            'App\Http\Controllers\Contracts\OrderInterface',
            'App\Http\Controllers\Repositories\OrderRepository'
        );
    }
}
