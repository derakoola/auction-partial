<?php

namespace App\Http\Middleware\Web\V1;

use Closure;

class SetLocale
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $storedLocale = $request->cookie('locale');
        $locale = $request->segment(1);

        if ($storedLocale === $locale) {
            app()->setLocale($locale);
            return $next($request);
        }

        return redirect()->to($request->url())->withCookie(cookie()->forever('locale', $locale));
    }
}
