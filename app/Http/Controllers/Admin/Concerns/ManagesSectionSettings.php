<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Http\Request;

/**
 * Shared behaviour for the admin "section" pages that write into the
 * key/value settings table.
 *
 * Text fields are saved per language (English into the plain key, every other
 * language into a suffixed one). Fields that are not language-specific —
 * links, embed URLs, phone numbers, layout toggles — are always saved against
 * the base key so all languages keep sharing a single value.
 */
trait ManagesSectionSettings
{
    /**
     * The language the admin picked in the page's dropdown.
     */
    protected function editingLocale(Request $request): string
    {
        $requested = $request->input('lang');

        return ($requested && site_languages()->has($requested)) ? $requested : base_locale();
    }

    /**
     * Save one section's settings for the language the admin is editing.
     *
     * @param  string  $section  key into config/translatable.php
     */
    protected function saveSectionSettings(Request $request, string $section): string
    {
        $locale = $this->editingLocale($request);

        foreach (config('translatable.sections.' . $section, []) as $field) {
            update_settings_for($field, $request->input($field, ''), $locale);
        }

        // Shared fields are only writable while editing the default language,
        // so a translation pass can never blank out a link or a phone number.
        if ($locale === base_locale()) {
            foreach (config('translatable.shared.' . $section, []) as $field) {
                update_settings($field, $request->input($field, ''));
            }
        }

        cache()->flush();

        return $locale;
    }
}
