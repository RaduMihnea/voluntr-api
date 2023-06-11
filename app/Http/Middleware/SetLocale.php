<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next): mixed
    {
        $locale = $request->server('HTTP_ACCEPT_LANGUAGE');

        if ($locale) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
