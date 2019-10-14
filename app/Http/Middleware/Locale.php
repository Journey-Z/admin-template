<?php

namespace App\Http\Middleware;

use Closure;

use App;
use Session;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Session::has('locale')){
            $locale = config('app.fallback_locale');
            Session::put('locale', $locale);
        }
        $locale = Session::get('locale');
        App::setLocale($locale);
        return $next($request);
    }

}
