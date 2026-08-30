<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class SliderItem extends Model
{
    use HasTranslations;

    /**
     * Text columns the admin can translate per language.
     * The columns themselves hold the default-locale (English) copy.
     */
    protected array $translatable = [
        'text',
    ];


    protected $fillable = [
        'text',
        'logo',
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
