<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Events\ChirpCreated;
// Add use lines
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * @return HasMany
     *
     * The first is the obvious part of the E-R Diagram
     */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    /**
     * The second relationship allows us to check if the user has voted (liked or disliked) a chirp
     */
    public function userVotes(): HasOne
    {
        // "For this Chirp, look at its votes, and retrieve one vote where the User has the same ID as the currently logged-in User".
        return $this->votes()
            ->one()
            ->where('user_id', auth()->id());
    }

}
