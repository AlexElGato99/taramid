<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Language;
use App\Models\Settings;
use Intervention\Image\Facades\Image;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class SettingsController extends Controller
{
    public function index(Request $request, $tab = 'general')
    {
        $activeTab = in_array($tab, ['general', 'email', 'api', 'seo']) ? $tab : 'general';

        $config = [
            'title' => __('Settings'),
            'nav' => 'settings',
        ];

        $tab = [
            'general' => [
                'title' => 'General',
                'nav' => 'general',
                'icon' => 'settings',
            ],
            'email' => [
                'title' => 'Email',
                'nav' => 'email',
                'icon' => 'user',
            ],
            'api' => [
                'title' => 'Api',
                'nav' => 'api',
                'icon' => 'genre',
            ],
            'seo' => [
                'title' => 'SEO',
                'nav' => 'seo',
                'icon' => 'genre',
            ]
        ];
        $languages = Language::get();

        return view('admin.settings.index', compact('config', 'tab', 'languages', 'activeTab'));
    }

    public function update(Request $request, Factory $cache, Settings $settings)
    {
        if ($request->isMethod('post')) {

            $tab_fields = [
                'general' => [
                    'site_name',
                    'site_about',
                    'whatsapp_number',
                    'telegram_username',
                    'language',
                    'admin_language',
                    'default_language',
                    'logo_height',
                    'custom_code',
                    'register',
                    'cookie',
                    'cookie_message',
                    'cookie_button_text',
                    'cookie_decline_text',
                    'subscription',
                    'landing',
                    'preloader',
                    'terms_url',
                    'privacy_url',
                    'cookie_url',
                    'facebook',
                    'twitter',
                    'instagram',
                    'youtube',
                    'footer_description',
                    'landing_title',
                    'landing_description',
                    'landing_body',
                    'to_email',
                    'hero_icons_color',
                    'currency',

                    'title',
                    'description',
                    'broadcasts_title',
                    'broadcasts_description',
                    'blog_title',
                    'blog_description',
                    'faq_title',
                    'faq_description',
                    'tutorial_title',
                    'tutorial_description',
                    'contact_title',
                    'contact_description',
                    'pricing_title',
                    'pricing_description',
                    
                    'home_seo_title',
                    'channels_seo_title',
                    'blog_seo_title',
                    'faq_seo_title',
                    'tutorial_seo_title',
                    'contact_seo_title',
                    'pricing_seo_title',
                ],
                'email' => [
                    'to_email',
                    'order_notification_email',
                ],
                'payment' => [
                    'paypal',
                    'paypal_mode',
                    'paypal_client_id',
                    'paypal_secret',
                    'paypal_webhook_id',
                    'stripe',
                    'stripe_mode',
                    'stripe_key',
                    'stripe_secret_key',
                    'stripe_signing_secret',
                    'paygate',
                    'paygate_wallet_address',
                    'paygate_provider_mode',
                    'paygate_single_provider',
                    'paygate_providers',
                    'paygate_tab_name',
                    'paygate_heading',
                    'paygate_description',
                    'bank',
                    'bank_detail',
                    'bank_name',
                    'bank_account_name',
                    'bank_account_number',
                    'bank_iban',
                    'bank_tab_name',
                    'bank_heading',
                    'bank_description',
                    'bank_feature_1',
                    'bank_feature_2',
                    'bank_feature_3',
                    'card_tab_name',
                    'card_heading',
                    'card_description',
                    'card_feature_1',
                    'card_feature_2',
                    'card_feature_3',
                    'whatsapp_enabled',
                    'whatsapp_tab_name',
                    'whatsapp_heading',
                    'whatsapp_description',
                    'whatsapp_message',
                    'whatsapp_feature_1',
                    'whatsapp_feature_2',
                    'whatsapp_feature_3',
                    'telegram_enabled',
                    'telegram_tab_name',
                    'telegram_heading',
                    'telegram_description',
                    'telegram_message',
                    'telegram_feature_1',
                    'telegram_feature_2',
                    'telegram_feature_3',
                    'payment_link_enabled',
                    'payment_link_tab_name',
                    'payment_link_heading',
                    'payment_link_description',
                    'payment_link_field_name',
                    'payment_link_field_email',
                    'payment_link_field_phone',
                    'payment_link_button_text',
                    'payment_link_message',
                    'payment_link_feature_1',
                    'payment_link_feature_2',
                    'payment_link_feature_3',
                ],
                'api' => [],
                'seo' => [
                    'seo_title',
                    'seo_description',
                    'seo_keywords',
                    'og_title',
                    'og_description',
                    'schema_business_name',
                    'schema_business_type',
                    'schema_email',
                    'schema_phone',
                    'schema_address',
                    'schema_founding_date',
                    'schema_price_range',
                    'google_verification',
                    'google_analytics',
                ],
            ];

            $activeTab = $request->input('_tab', 'general');
            $save_data = $tab_fields[$activeTab] ?? $tab_fields['general'];

            $static_path = public_path('static/img/');

            if (!\File::exists($static_path)) {
                \File::makeDirectory($static_path, 0755, true);
            }

            if ($activeTab === 'general') {
                if ($request->hasFile('logo')) {
                    $extension = $request->file('logo')->getClientOriginalExtension();
                    $logo = 'logo-' . time() . '.' . $extension;

                    if ($request->file('logo')->move($static_path, $logo)) {
                        if (config('settings.logo') and \File::exists($static_path . config('settings.logo'))) {
                            unlink($static_path . config('settings.logo'));
                        }
                    }
                    update_settings('logo', $logo);
                }

                if ($request->hasFile('dark_logo')) {
                    $extension = $request->file('dark_logo')->getClientOriginalExtension();
                    $dark_logo = 'dark-logo-' . time() . '.' . $extension;

                    if ($request->file('dark_logo')->move($static_path, $dark_logo)) {
                        if (config('settings.dark_logo') and \File::exists($static_path . config('settings.dark_logo'))) {
                            unlink($static_path . config('settings.dark_logo'));
                        }
                    }
                    update_settings('dark_logo', $dark_logo);
                }
                if ($request->hasFile('favicon')) {
                    $faviconPath = public_path(config('attr.favicon.path'));
                    if (!file_exists($faviconPath)) {
                        mkdir($faviconPath, 0777, true);
                    }
                    $faviconFile = $request->file('favicon');
                    $mime = $faviconFile->getMimeType();

                    if ($mime === 'image/svg+xml') {
                        $faviconFile->move($faviconPath, 'favicon.svg');
                        update_settings('favicon_type', 'svg');
                    } else {
                        @unlink($faviconPath . 'favicon.svg');
                        foreach (config('attr.favicon.sizes') as $size => $favicon) {
                            foreach (['png', 'jpg', 'gif', 'webp'] as $ext) {
                                @unlink($faviconPath . $favicon . '.' . $ext);
                            }
                            $img = Image::make($faviconFile)->orientate();
                            $img->fit($size, $size, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                            $img->encode('png', 100);
                            $img->save($faviconPath . $favicon . '.png');
                        }
                        update_settings('favicon_type', 'png');
                    }
                    update_settings('favicon_version', time());
                }
                $manifest = [
                    'name' => $request->site_name ?? config('settings.site_name'),
                    'short_name' => $request->site_name ?? config('settings.site_name'),
                    'icons' => [
                        [
                            "src" => asset(config('attr.favicon.path')) . "/android-chrome-192x192.png",
                            "sizes" => "192x192",
                            "type" => "image/png"
                        ],
                        [
                            "src" => asset(config('attr.favicon.path')) . "/android-chrome-512x512.png",
                            "sizes" => "512x512",
                            "type" => "image/png"
                        ]
                    ],
                    "theme_color" => "#ffffff",
                    "background_color" => "#ffffff",
                    "display" => "fullscreen",
                    "form_factor" => "wide",
                    "start_url" => "/"
                ];

                \File::put('site.webmanifest', json_encode($manifest,JSON_PRETTY_PRINT));
            }

            if ($activeTab === 'payment') {
                if ($request->has('paygate_providers')) {
                    update_settings('paygate_providers', json_encode($request->paygate_providers));
                } else {
                    update_settings('paygate_providers', json_encode([]));
                }

                if (!$request->has('card_enabled') || $request->card_enabled !== 'active') {
                    update_settings('stripe', null);
                    update_settings('paypal', null);
                }
            }
            
            // Tabs listed in config/translatable.php store their prose per
            // language: the chosen language gets its own copy, while shared
            // values (API keys, schema.org vocabulary) are only writable from
            // the default language so a translation pass cannot clear them.
            $translatableFields = config('translatable.sections.' . $activeTab, []);
            $sharedFields = config('translatable.shared.' . $activeTab, []);
            $contentLocale = admin_locale();

            foreach ($save_data as $item) {
                if ($item === 'paygate_providers') continue;

                if (in_array($item, $translatableFields, true)) {
                    update_settings_for($item, $request->$item, $contentLocale);
                    continue;
                }

                if ($contentLocale !== base_locale()
                    && ($sharedFields || $translatableFields)
                    && in_array($item, $sharedFields, true)) {
                    continue;
                }

                update_settings($item, $request->$item);
            }

            if ($activeTab === 'seo' && $contentLocale === base_locale()) {
                if ($request->hasFile('og_image')) {
                    $ogPath = public_path('storage/uploads/seo/');
                    if (!file_exists($ogPath)) {
                        mkdir($ogPath, 0777, true);
                    }
                    $ogFile = $request->file('og_image');
                    $ogName = 'og-image-' . time() . '.' . $ogFile->getClientOriginalExtension();
                    if (config('settings.og_image') && file_exists(public_path('storage/' . config('settings.og_image')))) {
                        @unlink(public_path('storage/' . config('settings.og_image')));
                    }
                    $ogFile->move($ogPath, $ogName);
                    update_settings('og_image', 'uploads/seo/' . $ogName);
                }
            }

            if ($activeTab === 'email') {
                $laravel_config = [
                    "MAIL_HOST",
                    "MAIL_PORT",
                    "MAIL_USERNAME",
                    "MAIL_PASSWORD",
                    "MAIL_ENCRYPTION",
                    "MAIL_FROM_ADDRESS",
                    "MAIL_FROM_NAME",
                ];
                $file = DotenvEditor::autoBackup(false);
                foreach ($laravel_config as $key) {
                    $file = DotenvEditor::setKey($key, $request->$key);
                }
                $file->save();
            }

            if ($activeTab === 'api') {
                if ($request->hasFile('GOOGLE_P12')) {
                    $request->file('GOOGLE_P12')->move(storage_path('app/analytics'), $request->file('GOOGLE_P12')->getClientOriginalName());
                }
                $laravel_config = [
                    "ONESIGNAL_APP_ID",
                    "ONESIGNAL_REST_API_KEY",
                    "GOOGLE_CLIENT_ID",
                    "GOOGLE_CLIENT_SECRET",
                    "GOOGLE_REDIRECT_URI",
                    "GOOGLE_P12",
                    "ANALYTICS_PROPERTY_ID",
                    "GA_MEASUREMENT_ID",
                ];
                $file = DotenvEditor::autoBackup(false);
                foreach ($laravel_config as $key) {
                    if ($key == 'GOOGLE_P12') {
                        if($request->hasFile('GOOGLE_P12')) {
                            $file = DotenvEditor::setKey($key, $request->file('GOOGLE_P12')->getClientOriginalName());
                        } else {
                            $currentFile = basename(config('analytics.service_account_credentials_json'));
                            $file = DotenvEditor::setKey($key, $currentFile);
                        }
                    } else {
                        $file = DotenvEditor::setKey($key, $request->$key);
                    }
                }
                $file->save();
            }

            Cache::forget('settings');
            Cache::flush();
            return redirect()->back()->with('success', __('Changes Saved'));
        }
    }
}
