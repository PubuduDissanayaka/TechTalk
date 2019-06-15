<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotyfyUserRating extends Notification implements ShouldQueue
{
    use Queueable;
    public $userRating;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->$userRating = $userRating;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $ratinguser = $this->userRating->user->name;
        $userid = $this->userRating->user_id;
        return (new MailMessage)
                    ->from('notify@techtalk.com', 'Notify')
                    ->subject('New Rating Notification')
                    ->line($ratinguser .' has rated on your profile on TechTalk.. ')
                    ->action('See your Profile', url('http://127.0.0.1:8000/profile/'. $studid))
                    ->line('Thank you for using TechTalk!');
    }

}
