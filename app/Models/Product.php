<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use Sluggable;
    use HasTranslations;

    /**
     * Text columns the admin can translate per language.
     * The columns themselves hold the default-locale (English) copy.
     */
    protected array $translatable = [
        'title',
        'description',
        'how_to_use',
        'ingredients',
        'general_instructions',
        'size',
        'badge',
        'tag1',
        'tag2',
        'link_text',
        'action_buttons',
    ];


    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'description',
        'image',
        'gallery',
        'how_to_use',
        'ingredients',
        'general_instructions',
        'size',
        'price',
        'currency',
        'badge',
        'tag1',
        'tag2',
        'is_featured',
        'link',
        'link_text',
        'action_buttons',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'gallery' => 'array',
        'action_buttons' => 'array',
        'price' => 'decimal:2',
    ];

    public function sluggable(): array
    {
        return ['slug' => ['source' => 'title']];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Action buttons for the active locale.
     *
     * Only the label is translated: the icon and the link target (email
     * address, WhatsApp number, URL) always come from the default language,
     * so translating a button can never break where it points.
     */
    public function actionButtons(?string $locale = null): array
    {
        $baseButtons = $this->action_buttons ?? [];

        $translated = $this->t('action_buttons', $locale);
        if (is_string($translated)) {
            $translated = json_decode($translated, true);
        }
        if (!is_array($translated) || !$translated) {
            $translated = $baseButtons;
        }

        $buttons = [];
        foreach (array_values($translated) as $i => $button) {
            $base = $baseButtons[$i] ?? [];
            $buttons[] = [
                'icon' => $base['icon'] ?? ($button['icon'] ?? 'link'),
                'value' => $base['value'] ?? ($button['value'] ?? ''),
                'text' => trim((string) ($button['text'] ?? '')) !== ''
                    ? $button['text']
                    : ($base['text'] ?? ''),
            ];
        }

        return $buttons;
    }
}
