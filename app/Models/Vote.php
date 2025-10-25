<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    // add the fillable fields
    protected $fillable = [
        'chirp_id',
        'user_id',
        'vote',
    ];

}
