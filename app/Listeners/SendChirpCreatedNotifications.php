<?php

namespace App\Listeners;

use App\Events\ChirpCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
// Add use lines
use App\Models\User;
use App\Notifications\NewChirp;

class SendChirpCreatedNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ChirpCreated $event): void
    {
        // It  tells Laravel that we want to send the notification to every user that is on
        // our Chirper platform... except for the user who wrote the new Chirp.
        foreach (User::whereNot('id', $event->chirp->user_id)->cursor() as $user) {

            $user->notify(new NewChirp($event->chirp));

        }
    }
}
