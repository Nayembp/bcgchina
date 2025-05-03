<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDonation extends Model
{
    protected $fillable = [
        'user_id',
        'previous_balance',
        'current_balance',
        'amount',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
