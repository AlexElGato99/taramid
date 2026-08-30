<?php

namespace App\Traits;

use App\Models\Translation;

/**
 * Adds per-locale overrides for text columns.
 *
 * The base columns on the model always hold the default-locale (English) copy.
 * Any other locale is stored as a row in the `translations` table, and falls
 * back to the base column whenever a translation is missing or blank.
 *
 * Models using this trait must declare:
 *   protected array $translatable = ['title', 'description'];
 */
trait HasTranslations
{
    public static function bootHasTranslations(): void
    {
        static::deleting(function ($model) {
            $model->translations()->delete();
        });
    }

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

    public function translatableFields(): array
    {
        return $this->translatable ?? [];
    }

    /**
     * Translated value of a field for the given (or current) locale,
     * falling back to the base column.
     */
    public function t(string $field, ?string $locale = null)
    {
        $locale = $locale ?: app()->getLocale();

        if ($locale === base_locale() || !in_array($field, $this->translatableFields(), true)) {
            return $this->getAttribute($field);
        }

        $value = $this->translationValue($field, $locale);

        return ($value === null || $value === '') ? $this->getAttribute($field) : $value;
    }

    /**
     * Raw stored value for a locale with no fallback — used by admin forms so
     * an empty French field stays visibly empty instead of echoing English.
     */
    public function rawTranslation(string $field, ?string $locale = null)
    {
        $locale = $locale ?: app()->getLocale();

        if ($locale === base_locale()) {
            return $this->getAttribute($field);
        }

        return $this->translationValue($field, $locale);
    }

    protected function translationValue(string $field, string $locale)
    {
        $loaded = $this->relationLoaded('translations')
            ? $this->translations
            : $this->translations()->where('locale', $locale)->get();

        $row = $loaded->first(fn ($t) => $t->locale === $locale && $t->field === $field);

        return $row?->value;
    }

    /**
     * Persist a set of field => value pairs for one locale.
     * Writing the base locale updates the model's own columns.
     */
    public function saveTranslations(array $values, string $locale): void
    {
        $fields = $this->translatableFields();

        if ($locale === base_locale()) {
            $this->fill(array_intersect_key($values, array_flip($fields)))->save();
            return;
        }

        foreach ($values as $field => $value) {
            if (!in_array($field, $fields, true)) {
                continue;
            }

            // Structured fields (JSON columns) are stored serialised.
            if (is_array($value)) {
                $value = json_encode(array_values($value), JSON_UNESCAPED_UNICODE);
            }

            $this->translations()->updateOrCreate(
                ['locale' => $locale, 'field' => $field],
                ['value' => $value]
            );
        }

        $this->unsetRelation('translations');
    }

    /**
     * Eager-load translations for the active locale on a query.
     */
    public function scopeWithTranslations($query, ?string $locale = null)
    {
        $locale = $locale ?: app()->getLocale();

        return $query->with(['translations' => fn ($q) => $q->where('locale', $locale)]);
    }
}
