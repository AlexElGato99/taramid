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
}
