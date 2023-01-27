<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class Localization
{

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $language = $request->header('Accept-Language');
        if (!empty($language)) {
            Lang::setLocale($language);
        }
        return $next($request);
    }
}
