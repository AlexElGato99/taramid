<?php

namespace App\Providers;

use App\Models\Settings;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Factory $cache, Settings $settings)
    {
        try {
            if (env('APP_ENV') != 'install' AND Schema::hasTable('settings')) {
                $settings = $cache->rememberForever('settings', function () use ($settings) {
                    return $settings->pluck('val', 'name')->all();
                });
                config()->set('settings', $settings);
            }
        } catch (\Exception $e) {
            // Silently fail during bootstrap if database is not accessible
        }
    }
}
