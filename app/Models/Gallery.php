<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gallery extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }

    public function getCoverImageAttribute()
    {
        return $this->photos()->first()?->image_path ?? 'default/path/to/placeholder.jpg';
    }
}
