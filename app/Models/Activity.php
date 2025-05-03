<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'type_id',
        'name',
        'title',
        'description',
        'banner',
        'expanse',
    ];

    public function type()
    {
        return $this->belongsTo(ActivityType::class);
    }
}
