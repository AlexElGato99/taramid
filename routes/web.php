<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $heroSlides = \App\Models\HeroSlide::active()->withTranslations()->ordered()->get();
    return view('index', compact('heroSlides'));
})->name('index');

Route::get('/products', [ProductPageController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductPageController::class, 'show'])->name('products.show');

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/lang/{code}', [LocaleController::class, 'switch'])->name('locale.switch');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::get('/robots.txt', function () {
    $content = "User-agent: *\n";
    $content .= "Allow: /\n";
    $content .= "Disallow: /admin\n";
    $content .= "Disallow: /login\n";
    $content .= "Disallow: /register\n\n";
    $content .= "Sitemap: " . url('/sitemap.xml') . "\n";
    return response($content, 200, ['Content-Type' => 'text/plain']);
})->name('robots');

Route::get('logout', function () {
    Auth::logout();
    return redirect()->route('index');
})->name('logout');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
