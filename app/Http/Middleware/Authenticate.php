<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                /* 为什么用Redirect::guest()而不用Redirect::to()呢，通过api手册可以查到:Redirect::guest()
              在重定向时会将当前url保存到session中，这样可以在登陆以后，使用Redirect::intended()方法跳转到之前的页面继续业务。
              * */
                return redirect()->guest('auth/login');
            }
        }

        return $next($request);
    }
}
