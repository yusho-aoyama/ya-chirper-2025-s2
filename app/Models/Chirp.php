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

    /**
     * The attributes that should be hidden for serialization.
     * (came from github.com)
     *
     * @var list<string>
     */
    protected $hidden = [];

    /**
     * Get the attributes that should be cast.
     * (came from github.com)
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [];
    }

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
        // See the relationship btw user and chirp
        return $this->belongsTo(User::class);
    }

}
