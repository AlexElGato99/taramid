<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LocaleController extends Controller
{
    /**
     * Switch the frontend language from the navbar switcher.
     * The choice is kept in the session and in a one-year cookie so returning
     * visitors land on the language they picked.
     */
    public function switch(Request $request, string $code)
    {
        if (!site_languages()->has($code)) {
            return redirect()->back();
        }

        session()->put('locale', $code);
        app()->setLocale($code);

        return redirect()
            ->back()
            ->withCookie(Cookie::make('locale', $code, 60 * 24 * 365));
    }
}
