<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['gallery_id', 'title', 'description', 'image_path'];
    
    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }
}
