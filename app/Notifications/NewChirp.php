<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
// Add use lines
use App\Models\Chirp;
use Illuminate\Support\Str;

class NewChirp extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Chirp $chirp)
    {
        // It tells Laravel to send a Mail Message by creating a new instance of the
        // MailMessage class.
        return (new MailMessage)
            ->subject("New Chirp from {$this->chirp->user->name}") // Adding a subject
            ->greeting("New Chirp from {$this->chirp->user->name}") // Adding a greeting
            ->line(Str::limit($this->chirp->message, 50)) // Add the first line of the message (extract from chirp)
            ->action('Go to Chirper', url('/')) // Add a button to jump to the Chirper App
            ->line('Thank you for using our application!'); // Add a closing line of the message
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
