<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public $timestamps = false;

    protected $fillable = ['code', 'name'];

    /**
     * Native label shown in the frontend language switcher.
     */
    public function getNativeNameAttribute(): string
    {
        return config('languages.native.' . $this->code, $this->name);
    }

    public function getShortCodeAttribute(): string
    {
        return strtoupper(substr($this->code, 0, 2));
    }
}
