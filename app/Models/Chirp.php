<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Events\ChirpCreated;

class Chirp extends Model
{
    /** @use HasFactory<\Database\Factories\ChirpFactory> */
    use HasFactory;

    // Mass assignment
    protected $fillable = [
        'message',
    ];

    // Listen for this Model event and trigger the dispatch.
    protected $dispatchesEvents = [
        'created' => ChirpCreated::class,
    ];

    /**
     * A Chirp belongs to a User
     *
     * @return BelongsTo
     */
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
