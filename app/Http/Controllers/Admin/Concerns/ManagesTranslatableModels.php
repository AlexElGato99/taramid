<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Http\Request;

/**
 * Shared behaviour for the admin CRUD screens whose records carry translatable
 * text (products, FAQs, certificates, ...).
 *
 * A record is always created in the default language. Switching the language
 * dropdown on its edit screen then edits only that language's text, leaving
 * images, links, ordering and status alone.
 */
trait ManagesTranslatableModels
{
    protected function editingLocale(Request $request): string
    {
        $requested = $request->input('lang');

        return ($requested && site_languages()->has($requested)) ? $requested : base_locale();
    }

    protected function isTranslating(Request $request): bool
    {
        return $this->editingLocale($request) !== base_locale();
    }

    /**
     * Save the submitted text into one language and return to the edit screen
     * with that language still selected.
     */
    protected function storeTranslation(Request $request, $model, string $editRoute)
    {
        $locale = $this->editingLocale($request);
        $fields = $model->translatableFields();

        // Most translatable fields are plain text; a few (product action
        // buttons) are structured, so the rule follows what was submitted.
        $rules = [];
        foreach ($fields as $field) {
            $rules[$field] = is_array($request->input($field)) ? 'nullable|array' : 'nullable|string';
        }
        $rules['action_buttons.*.text'] = 'nullable|string|max:255';

        $request->validate($rules);

        $model->saveTranslations($request->only($fields), $locale);

        cache()->flush();

        return redirect()
            ->route($editRoute, [$model->getRouteKey(), 'lang' => $locale])
            ->with('success', __('Translation saved.'));
    }
}
