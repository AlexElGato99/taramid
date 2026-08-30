<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'account_type' => 'admin',
            'name' => 'Admin Author',
            'username' => 'admin',
            'about' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('admin'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('advertisements')->insert([
            'name' => 'Home Page - Top Banner',
            'placement' => 'home',
            'position' => 1,
            'body' => '',
            'status' => 'draft'
        ]);
        DB::table('advertisements')->insert([
            'name' => 'Pricing Page - Header Banner',
            'placement' => 'pricing',
            'position' => 1,
            'body' => '',
            'status' => 'draft'
        ]);

        $save_data = [
            'site_name' => 'My Site',
            'site_about' => 'Premium IPTV subscription service.',
            'language' => 'en',
            'title' => 'Premium IPTV Subscriptions',
            'description' => 'Stream thousands of live TV channels in HD and 4K.',
            'broadcasts_title' => 'Live TV Channels',
            'broadcasts_description' => 'Watch live TV channels in HD and 4K.',
            'blog_title' => 'Blog',
            'blog_description' => 'Latest news and updates.',
            'pricing_title' => 'Pricing',
            'pricing_description' => 'Choose the perfect subscription plan.',
            'faq_title' => 'FAQ',
            'faq_description' => 'Frequently asked questions.',
            'tutorial_title' => 'Tutorials',
            'tutorial_description' => 'Setup guides for all devices.',
            'contact_title' => 'Contact',
            'contact_description' => 'Get in touch with our support team.',
        ];

        foreach ($save_data as $key => $value) {
            update_settings($key, $value);
        }

        Cache::forget('settings');
        Cache::flush();

        DB::table('languages')->insert([
            'code'      => 'en',
            'direction' => 'ltr',
            'name'      => 'English'
        ]);
        DB::table('languages')->insert([
            'code'      => 'es',
            'direction' => 'ltr',
            'name'      => 'Español'
        ]);
        DB::table('languages')->insert([
            'code'      => 'de',
            'direction' => 'ltr',
            'name'      => 'Deutschland'
        ]);
        DB::table('languages')->insert([
            'code'      => 'fr',
            'direction' => 'ltr',
            'name'      => 'France'
        ]);
        DB::table('languages')->insert([
            'code'      => 'sv',
            'direction' => 'ltr',
            'name'      => 'Svenska'
        ]);
    }
}
