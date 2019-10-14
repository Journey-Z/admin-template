<?php

namespace App\Modules\Auth\Providers;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
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
		Lang::addNamespace('Auth', realpath(__DIR__.'/../Resources/Lang'));
		View::addNamespace('Auth', base_path('resources/views/vendor/Auth'));
		View::addNamespace('Auth', realpath(__DIR__.'/../Resources/Views'));
	}
}
