<?php

namespace App\Modules\Dashboard\Providers;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->registerNamespaces();
    }

    /**
	 * Register the Framework module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('Dashboard', realpath(__DIR__.'/../Resources/Lang'));
		View::addNamespace('Dashboard', base_path('resources/views/vendor/Dashboard'));
		View::addNamespace('Dashboard', realpath(__DIR__.'/../Resources/Views'));
	}
}
