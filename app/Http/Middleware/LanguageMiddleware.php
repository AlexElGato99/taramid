<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Priority: 1. Session locale, 2. Cookie locale, 3. Default frontend language, 4. App fallback
        $locale = null;
        
        if (session()->has('locale')) {
            $locale = session()->get('locale');
        } elseif ($request->hasCookie('locale')) {
            $locale = $request->cookie('locale');
            // Store cookie value in session for consistency
            session()->put('locale', $locale);
        } elseif (config('settings.default_language')) {
            // Use admin-configured default frontend language for first-time visitors
            $locale = config('settings.default_language');
        } else {
            $locale = config('app.fallback_locale', 'en');
        }
        
        // Verify the locale exists in database, fallback to first available language
        $language = \App\Models\Language::where('code', $locale)->first();
        if (!$language) {
            $firstLanguage = \App\Models\Language::first();
            $locale = $firstLanguage ? $firstLanguage->code : config('app.fallback_locale', 'en');
            session()->put('locale', $locale);
        }
        
        App::setLocale($locale);
        
        return $next($request);
    }
}
