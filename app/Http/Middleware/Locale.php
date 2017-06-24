<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

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
        $cookie = Cookie::get('locale');
        if (isset($cookie)) {
            if (in_array($cookie, config('i18n.support'))) {
                App::setLocale($cookie);
                return $next($request);
            } else {
                return abort(418);
            }
        } else {
            App::setLocale(config('app.locale'));
            return $next($request);
        }
    }
}
