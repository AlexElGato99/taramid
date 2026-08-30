<?php

use Illuminate\Support\Facades\Route;

Route::prefix("admin")->name("admin.")->middleware(["auth","auth.admin","admin.lang"])->group(function () {

    Route::get("/", [\App\Http\Controllers\Admin\IndexController::class, "index"])->name("index");
    Route::get("/live-visitors", [\App\Http\Controllers\Admin\IndexController::class, "liveVisitors"])->name("live-visitors");

    Route::get("/clear-cache", function () {
        Artisan::call("cache:clear");
        Artisan::call("route:clear");
        Artisan::call("view:clear");
        Artisan::call("config:clear");
        return redirect()->route("admin.index")->with("success", __("Cache cleared"));
    })->name("cache.clear");

    Route::controller(\App\Http\Controllers\Admin\NotificationController::class)->name("notifications.")->group(function () {
        Route::get("notifications-page", "page")->name("page");
        Route::get("notifications", "index")->name("index");
        Route::get("notifications/all", "all")->name("all");
        Route::get("notifications/unread-count", "unreadCount")->name("unread-count");
        Route::post("notifications/{id}/mark-as-read", "markAsRead")->name("mark-as-read");
        Route::post("notifications/mark-all-as-read", "markAllAsRead")->name("mark-all-as-read");
        Route::delete("notifications/{id}", "destroy")->name("destroy")->middleware("demo");
    });

    Route::controller(\App\Http\Controllers\Admin\SettingsController::class)->name("settings.")->group(function () {
        Route::get("settings/{tab?}", "index")->name("index")->where('tab', 'email|api|seo');
        Route::post("settings", "update")->name("update")->middleware("demo");
    });

    Route::controller(\App\Http\Controllers\Admin\CustomizeController::class)->name("customize.")->group(function () {
        Route::get("customize", "index")->name("index");
        Route::post("customize", "update")->name("update")->middleware("demo");
    });

    Route::controller(\App\Http\Controllers\Admin\UpdaterController::class)->name("updater.")->group(function () {
        Route::get("updater", "index")->name("index");
        Route::post("updater", "update")->name("update")->middleware("demo");
    });

    Route::controller(\App\Http\Controllers\Admin\UserController::class)->name("user.")->group(function () {
        Route::get("users", "index")->name("index");
        Route::get("user/create", "create")->name("create");
        Route::post("user", "store")->name("store")->middleware("demo");
        Route::get("user/{user}/edit", "edit")->name("edit");
        Route::put("user/{user}", "update")->name("update")->middleware("demo");
        Route::delete("user/{user}", "destroy")->name("destroy")->middleware("demo");
    });

    Route::controller(\App\Http\Controllers\Admin\LanguageController::class)->name("language.")->group(function () {
        Route::get("languages", "index")->name("index");
        Route::get("language/create", "create")->name("create");
        Route::post("language", "store")->name("store")->middleware("demo");
        Route::get("language/{language}/edit", "edit")->name("edit");
        Route::put("language/{language}", "update")->name("update")->middleware("demo");
        Route::delete("language/{language}", "destroy")->name("destroy")->middleware("demo");
    });

    Route::controller(\App\Http\Controllers\Admin\HeroSlideController::class)->name("hero-slides.")->group(function () {
        Route::get("hero-slides", "index")->name("index");
        Route::get("hero-slides/create", "create")->name("create");
        Route::post("hero-slides", "store")->name("store")->middleware("demo");
        Route::get("hero-slides/{hero_slide}/edit", "edit")->name("edit");
        Route::put("hero-slides/{hero_slide}", "update")->name("update")->middleware("demo");
        Route::delete("hero-slides/{hero_slide}", "destroy")->name("destroy")->middleware("demo");
    });

    Route::controller(\App\Http\Controllers\Admin\QuickStatsController::class)->name("quick-stats.")->group(function () {
        Route::get("quick-stats", "index")->name("index");
        Route::post("quick-stats", "update")->name("update")->middleware("demo");
    });

    Route::controller(\App\Http\Controllers\Admin\OurStoryController::class)->name("our-story.")->group(function () {
        Route::get("our-story", "index")->name("index");
        Route::post("our-story", "update")->name("update")->middleware("demo");
    });

    Route::controller(\App\Http\Controllers\Admin\ProcessSectionController::class)->name("process-section.")->group(function () {
        Route::get("process-section", "index")->name("index");
        Route::post("process-section", "update")->name("update")->middleware("demo");
    });

    Route::controller(\App\Http\Controllers\Admin\ProcessStepController::class)->name("process-steps.")->group(function () {
        Route::get("process-steps", "index")->name("index");
        Route::get("process-steps/create", "create")->name("create");
        Route::post("process-steps", "store")->name("store")->middleware("demo");
        Route::get("process-steps/{process_step}/edit", "edit")->name("edit");
        Route::put("process-steps/{process_step}", "update")->name("update")->middleware("demo");
        Route::delete("process-steps/{process_step}", "destroy")->name("destroy")->middleware("demo");
    });

    Route::controller(\App\Http\Controllers\Admin\ProductSectionController::class)->name("products-section.")->group(function () {
        Route::get("products-section", "index")->name("index");
        Route::post("products-section", "update")->name("update")->middleware("demo");
    });

    Route::controller(\App\Http\Controllers\Admin\ProductController::class)->name("products.")->group(function () {
        Route::get("products", "index")->name("index");
        Route::get("products/create", "create")->name("create");
        Route::post("products", "store")->name("store")->middleware("demo");
        Route::get("products/{product}/edit", "edit")->name("edit");
        Route::put("products/{product}", "update")->name("update")->middleware("demo");
        Route::delete("products/{product}", "destroy")->name("destroy")->middleware("demo");
    });

    Route::controller(\App\Http\Controllers\Admin\CategoryController::class)->name("categories.")->group(function () {
        Route::get("categories", "index")->name("index");
        Route::get("categories/create", "create")->name("create");
        Route::post("categories", "store")->name("store")->middleware("demo");
        Route::get("categories/{category}/edit", "edit")->name("edit");
        Route::put("categories/{category}", "update")->name("update")->middleware("demo");
        Route::delete("categories/{category}", "destroy")->name("destroy")->middleware("demo");
    });

    Route::controller(\App\Http\Controllers\Admin\CertSectionController::class)->name("cert-section.")->group(function () {
        Route::get("cert-section", "index")->name("index");
        Route::post("cert-section", "update")->name("update")->middleware("demo");
    });

    Route::controller(\App\Http\Controllers\Admin\CertificateController::class)->name("certificates.")->group(function () {
        Route::get("certificates", "index")->name("index");
        Route::get("certificates/create", "create")->name("create");
        Route::post("certificates", "store")->name("store")->middleware("demo");
        Route::get("certificates/{certificate}/edit", "edit")->name("edit");
        Route::put("certificates/{certificate}", "update")->name("update")->middleware("demo");
        Route::delete("certificates/{certificate}", "destroy")->name("destroy")->middleware("demo");
    });

    Route::controller(\App\Http\Controllers\Admin\ContactSectionController::class)->name("contact-section.")->group(function () {
        Route::get("contact-section", "index")->name("index");
        Route::post("contact-section", "update")->name("update")->middleware("demo");
    });

    Route::controller(\App\Http\Controllers\Admin\FooterSectionController::class)->name("footer-section.")->group(function () {
        Route::get("footer-section", "index")->name("index");
        Route::post("footer-section", "update")->name("update")->middleware("demo");
    });

    Route::controller(\App\Http\Controllers\Admin\SliderItemController::class)->name("slider-items.")->group(function () {
        Route::get("slider-items", "index")->name("index");
        Route::get("slider-items/create", "create")->name("create");
        Route::post("slider-items", "store")->name("store")->middleware("demo");
        Route::get("slider-items/{slider_item}/edit", "edit")->name("edit");
        Route::put("slider-items/{slider_item}", "update")->name("update")->middleware("demo");
        Route::delete("slider-items/{slider_item}", "destroy")->name("destroy")->middleware("demo");
    });

    Route::controller(\App\Http\Controllers\Admin\FaqSectionController::class)->name("faq-section.")->group(function () {
        Route::get("faq-section", "index")->name("index");
        Route::post("faq-section", "update")->name("update")->middleware("demo");
    });

    Route::controller(\App\Http\Controllers\Admin\FaqController::class)->name("faqs.")->group(function () {
        Route::get("faqs", "index")->name("index");
        Route::get("faqs/create", "create")->name("create");
        Route::post("faqs", "store")->name("store")->middleware("demo");
        Route::get("faqs/{faq}/edit", "edit")->name("edit");
        Route::put("faqs/{faq}", "update")->name("update")->middleware("demo");
        Route::delete("faqs/{faq}", "destroy")->name("destroy")->middleware("demo");
    });

    Route::controller(\App\Http\Controllers\Admin\GallerySectionController::class)->name("gallery-section.")->group(function () {
        Route::get("gallery-section", "index")->name("index");
        Route::post("gallery-section", "update")->name("update")->middleware("demo");
    });

    Route::controller(\App\Http\Controllers\Admin\GalleryController::class)->name("gallery.")->group(function () {
        Route::get("gallery", "index")->name("index");
        Route::post("gallery", "store")->name("store")->middleware("demo");
        Route::put("gallery/{galleryImage}", "update")->name("update")->middleware("demo");
        Route::delete("gallery/{galleryImage}", "destroy")->name("destroy")->middleware("demo");
    });
});