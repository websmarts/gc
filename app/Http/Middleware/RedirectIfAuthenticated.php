<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
           
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {

            // if auth user is a contact
            if ($guard == "contact" && Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::CONTACT_HOME);
            }


            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
