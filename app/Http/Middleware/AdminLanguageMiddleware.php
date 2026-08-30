<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AdminLanguageMiddleware
{
    /**
     * Handle an incoming request.
     * Sets the admin panel language separately from frontend language.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $adminLocale = config('settings.admin_language', 'en');
        
        $language = \App\Models\Language::where('code', $adminLocale)->first();
        
        if (!$language) {
            $adminLocale = 'en';
        }
        
        App::setLocale($adminLocale);
        
        return $next($request);
    }
}
