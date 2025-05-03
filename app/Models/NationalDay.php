<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NationalDay extends Model
{
    protected $fillable = [
        'banner',
        'name',
        'note',
        'bg_music',
        'date',
        'is_active'
    ];
}
