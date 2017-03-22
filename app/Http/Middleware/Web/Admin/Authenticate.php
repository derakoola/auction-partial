<?php

namespace App\Http\Middleware\Web\Admin;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            return redirect('/')->withErrors(['all.accessDenied']);
        }
        $user = $request->user();

        if ($user->_email != 'morteza.php@gmail.com') {
            return redirect('/')->withErrors(['all.accessDenied']);
        }


        return $next($request);
    }
}
