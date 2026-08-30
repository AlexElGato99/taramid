<?php

use Intervention\Image\Facades\Image;

use App\Models\Settings;

function update_settings($key, $value)
{
    if (!Settings::where('name', $key)->first()) {
        Settings::create([
            'name' => $key,
            'val' => $value ?? '',
        ]);

        return true;
    } else {
        Settings::where('name', $key)->update([
            'name' => $key,
            'val' => $value ?? '',
        ]);
        \Illuminate\Support\Facades\Cache::forget($key);

        return true;
    }
}

if (!function_exists('fileUpload')) {
    function fileUpload($img, $path, $width = null, $height = null, $imgName = null, $webp = null)
    {
        if (isset($img)) {
            try {
                if (!file_exists(public_path($path))) {
                    mkdir(public_path($path), 0777, true);
                }

                $makeImg = Image::make($img)->orientate();
                $makeImg->encode($webp, 100);
                $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/gif' => 'gif', 'image/webp' => 'webp'];
                $mime = $makeImg->mime();

                $imgName = $imgName . '.' . $allowed[$mime];
                $imgPath = public_path($path . $imgName);

                if (isset($width) && isset($height)) {
                    if ($width == $height) {
                        $makeImg->fit($width, $height, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    } else {
                        $makeImg->fit($width, $height, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                } elseif (isset($width)) {
                    $makeImg->resize($width, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }

                if ($makeImg->save($imgPath)) {
                    return $imgName;
                }
            } catch (\Exception $e) {
            }
        }
        return false;
    }
}

if (!function_exists('editor_preview')) {
    function editor_preview($text = null)
    {
        $searchVal = array(
            '<h1>',
            '<h2>',
            '<h3>',
            '<h4>',
            '<h5>',
            '<p>',
        );
        $replaceVal = array(
            '<h1 class="text-gray-700 dark:text-gray-200 text-4xl font-semibold mb-4">',
            '<h2 class="text-gray-700 dark:text-gray-200 text-3xl font-semibold mb-4">',
            '<h3 class="text-gray-700 dark:text-gray-200 text-xl font-semibold mb-3">',
            '<h4 class="text-gray-700 dark:text-gray-200 text-lg font-semibold mb-3">',
            '<h5 class="text-gray-700 dark:text-gray-200 text-base font-semibold mb-3">',
            '<p class="text-gray-600 dark:text-gray-400 text-base mb-3">',
        );
        return str_replace($searchVal, $replaceVal, $text);
    }
}

if (!function_exists('gravatar')) {
    function gravatar($name = null, $image = null, $class = null)
    {
        if (isset($image)) {
            return '<div class="bg-cover ' . $class . '" style="background-image:url(' . $image . ');"></div>';
        } else {
            return '<div class="text-white ' . $class . '">' . mb_strtoupper(mb_substr($name, 0, 1, 'UTF-8'), 'UTF-8') . '</div>';
        }
    }
}

if (!function_exists('cover')) {
    function cover($image = null, $class = null)
    {
        if (isset($image)) {
            return '<div class="bg-cover ' . $class . '" style="background-image:url(' . $image . ');"></div>';
        } else {
            return '<div class="bg-cover ' . $class . '" style="background-image:url(' . asset('uploads/static/img/cover.png') . ');"></div>';
        }
    }
}

if (!function_exists('webper')) {
    function webper($image = '')
    {
        $searchVal = ['jpg', 'jpeg', 'png'];
        $replaceVal = ['webp', 'webp', 'webp'];

        return str_replace($searchVal, $replaceVal, $image);
    }
}

if (!function_exists('picture')) {
    function picture($image = null, $size = null, $class = null, $title = null)
    {
        $sizeHtml = null;
        if (isset($size)) {
            $sizeExp = explode(',', $size);
            $sizeHtml = 'width="' . $sizeExp[0] . '" height="' . $sizeExp[1] . '"';
        }

        if (isset($image)) {
            return '<picture>
                <source data-srcset="' . webper($image) . '" type="image/webp" class="' . $class . '">
                <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="' . $image . '" alt="' . $title . '" class="lazyload ' . $class . '" ' . $sizeHtml . '>
            </picture>';
        }

    }
}

if (!function_exists('short_number')) {
    function short_number(int $n)
    {
        if ($n >= 0 && $n < 1000) {
            $n_format = floor($n);
            $suffix = '';
        } elseif ($n >= 1000 && $n < 1000000) {
            $n_format = floor($n / 1000);
            $suffix = 'K+';
        } elseif ($n >= 1000000 && $n < 1000000000) {
            $n_format = floor($n / 1000000);
            $suffix = 'M+';
        } elseif ($n >= 1000000000 && $n < 1000000000000) {
            $n_format = floor($n / 1000000000);
            $suffix = 'B+';
        } elseif ($n >= 1000000000000) {
            $n_format = floor($n / 1000000000000);
            $suffix = 'T+';
        }

        return !empty($n_format . $suffix) ? $n_format . $suffix : 0;
    }
}


if (!function_exists('money_format')) {
    function money_format($amount, $currency, $separator = true, $translate = true)
    {
        if (in_array(strtoupper($currency), config('currencies.zero_decimals'))) {
            return number_format($amount, 0, $translate ? __('.') : '.', $separator ? ($translate ? __(',') : ',') : false);
        } else {
            return number_format($amount, 2, $translate ? __('.') : '.', $separator ? ($translate ? __(',') : ',') : false);
        }
    }
}
if (!function_exists('hexToRgb')) {

    function hexToRgb($hex, $alpha = false)
    {
        $hex = str_replace('#', '', $hex);
        $split = str_split($hex, 2);
        $r = hexdec($split[0]);
        $g = hexdec($split[1]);
        $b = hexdec($split[2]);
        return $r . ' ' . $g . ' ' . $b;
    }
}

if (!function_exists('changeRate')) {
    function changeRate($old, $new, int $precision = 2): float
    {
        if ($old == 0) {
            $old++;
            $new++;
        }

        $change = (($new - $old) / $old) * 100;

        return round($change, $precision);
    }
}

/*
|--------------------------------------------------------------------------
| Multilingual content helpers
|--------------------------------------------------------------------------
|
| Content lives in two places: the `settings` key/value table (section copy)
| and regular Eloquent models (products, FAQs, ...). In both cases the base
| record holds the default-locale (English) copy and every other locale is a
| suffixed settings row or a `translations` row, falling back to the base.
|
*/

if (!function_exists('base_locale')) {
    /**
     * The locale whose content is stored in the base columns / unsuffixed
     * settings keys. Everything else is an override of this.
     */
    function base_locale(): string
    {
        return config('app.fallback_locale', 'en');
    }
}

if (!function_exists('site_languages')) {
    /**
     * All languages available on the site, keyed by code.
     * Always contains at least the base locale so the UI never renders empty.
     */
    function site_languages()
    {
        static $languages = null;

        if ($languages !== null) {
            return $languages;
        }

        try {
            $languages = \App\Models\Language::orderBy('id')->get()->keyBy('code');
        } catch (\Throwable $e) {
            $languages = collect();
        }

        if ($languages->isEmpty()) {
            $languages = collect([
                base_locale() => new \App\Models\Language([
                    'code' => base_locale(),
                    'name' => 'English',
                ]),
            ]);
        }

        return $languages;
    }
}

if (!function_exists('setting_key')) {
    /**
     * Storage key for a setting in a given locale.
     * Base locale keeps the plain key so existing data stays untouched.
     */
    function setting_key(string $key, ?string $locale = null): string
    {
        $locale = $locale ?: app()->getLocale();

        return $locale === base_locale() ? $key : $key . '__' . $locale;
    }
}

if (!function_exists('setting')) {
    /**
     * Locale-aware read of a setting, falling back to the base-locale value.
     */
    function setting(string $key, $default = null, ?string $locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        $settings = config('settings', []);

        if ($locale !== base_locale()) {
            $translated = $settings[setting_key($key, $locale)] ?? null;
            if ($translated !== null && $translated !== '') {
                return $translated;
            }
        }

        $value = $settings[$key] ?? null;

        return ($value === null || $value === '') ? $default : $value;
    }
}

if (!function_exists('setting_raw')) {
    /**
     * Read a setting for one specific locale with no fallback, so admin forms
     * show an empty French field instead of echoing the English copy.
     */
    function setting_raw(string $key, ?string $locale = null, $default = null)
    {
        $value = config('settings.' . setting_key($key, $locale), null);

        return ($value === null || $value === '') ? $default : $value;
    }
}

if (!function_exists('update_settings_for')) {
    /**
     * Write a setting value for one locale.
     */
    function update_settings_for(string $key, $value, ?string $locale = null): bool
    {
        return update_settings(setting_key($key, $locale), $value);
    }
}

if (!function_exists('admin_locale')) {
    /**
     * Which locale the admin is currently editing content for, chosen by the
     * language dropdown on each settings page (?lang=fr). Falls back to base.
     */
    function admin_locale(): string
    {
        $requested = request()->input('lang');

        if ($requested && site_languages()->has($requested)) {
            return $requested;
        }

        return base_locale();
    }
}

if (!function_exists('admin_value')) {
    /**
     * Value to prefill an admin settings field with, for the language the
     * admin picked in the page's language dropdown.
     *
     * Deliberately does NOT fall back to the base locale: an untranslated
     * French field must look empty so the admin can see what still needs work.
     */
    function admin_value(string $key, $default = null)
    {
        $locale = admin_locale();

        if ($locale === base_locale()) {
            return setting_raw($key, $locale, $default);
        }

        return setting_raw($key, $locale, null);
    }
}

if (!function_exists('admin_placeholder')) {
    /**
     * Placeholder for an admin settings field. While translating, the
     * base-locale copy is shown as a greyed-out reference to translate from.
     */
    function admin_placeholder(string $key, string $default = ''): string
    {
        if (admin_locale() === base_locale()) {
            return $default;
        }

        return (string) setting_raw($key, base_locale(), $default);
    }
}

if (!function_exists('admin_lang_url')) {
    /**
     * Current admin URL with the content language swapped, used by the
     * language dropdown on every settings page.
     */
    function admin_lang_url(string $code): string
    {
        $query = array_merge(request()->query(), ['lang' => $code]);

        return request()->url() . '?' . http_build_query($query);
    }
}

if (!function_exists('model_value')) {
    /**
     * Value to prefill an admin CRUD field with, for the language the admin
     * picked. Like admin_value(), an untranslated field stays visibly empty.
     */
    function model_value($model, string $field, $default = '')
    {
        if (!$model) {
            return $default;
        }

        $value = $model->rawTranslation($field, admin_locale());

        return ($value === null || $value === '')
            ? (admin_locale() === base_locale() ? $default : '')
            : $value;
    }
}

if (!function_exists('model_placeholder')) {
    /**
     * Placeholder for an admin CRUD field: the default-language copy while
     * translating, so the admin can see what they are translating from.
     */
    function model_placeholder($model, string $field, string $default = ''): string
    {
        if (!$model || admin_locale() === base_locale()) {
            return $default;
        }

        return (string) ($model->getAttribute($field) ?: $default);
    }
}

if (!function_exists('is_rtl')) {
    /**
     * Whether a locale is written right-to-left. Driven by config/languages.php
     * so adding another RTL language (Hebrew, Persian, Urdu) is a config edit,
     * not a code change.
     */
    function is_rtl(?string $locale = null): bool
    {
        $locale = $locale ?: app()->getLocale();

        return in_array($locale, config('languages.rtl', []), true);
    }
}

if (!function_exists('text_direction')) {
    /**
     * Value for the document's dir attribute.
     */
    function text_direction(?string $locale = null): string
    {
        return is_rtl($locale) ? 'rtl' : 'ltr';
    }
}
