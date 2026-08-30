<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    use HasTranslations;

    /**
     * Text columns the admin can translate per language.
     * The columns themselves hold the default-locale (English) copy.
     */
    protected array $translatable = [
        'badge_text',
        'heading_line1',
        'heading_line2',
        'description',
        'button1_text',
        'button2_text',
        'stat1_value',
        'stat1_label',
        'stat2_value',
        'stat2_label',
        'stat3_value',
        'stat3_label',
        'stat4_value',
        'stat4_label',
    ];


    protected $fillable = [
        'badge_text',
        'heading_line1',
        'heading_line2',
        'description',
        'button1_text',
        'button1_link',
        'button2_text',
        'button2_link',
        'image',
        'stat1_value',
        'stat1_label',
        'stat2_value',
        'stat2_label',
        'stat3_value',
        'stat3_label',
        'stat4_value',
        'stat4_label',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
