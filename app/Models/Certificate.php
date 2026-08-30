<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasTranslations;

    /**
     * Text columns the admin can translate per language.
     * The columns themselves hold the default-locale (English) copy.
     */
    protected array $translatable = [
        'title',
        'description',
        'status_label',
        'detail_line',
    ];


    protected $fillable = [
        'title',
        'description',
        'icon',
        'status_label',
        'detail_line',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
