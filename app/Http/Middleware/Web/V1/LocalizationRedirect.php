<?php

namespace App\Http\Middleware\Web\V1;

use App\Helpers\Api\V1\ApiHelper;
use Closure;

class LocalizationRedirect
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
        $supportedLocales = ApiHelper::getLocales(false, true);

        $storedLocale = (string)$request->cookie('locale');
        if (in_array($storedLocale, $supportedLocales)) {
            return redirect()->to($storedLocale);
        }

        $locale = $request->getPreferredLanguage($supportedLocales);
        if (!in_array($locale, $supportedLocales)) {
            $locale = $supportedLocales[0];
        }

        return redirect()->to($locale)->withCookie(cookie()->forever('locale', $locale));
    }
}
