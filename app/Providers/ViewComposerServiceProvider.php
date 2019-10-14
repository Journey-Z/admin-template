<?php

namespace App\Providers;

use App\ViewComposers\MenuComposer;
use View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // 使用基于类的 composer...
        View::composer(['Dashboard::layouts.menu'], MenuComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
