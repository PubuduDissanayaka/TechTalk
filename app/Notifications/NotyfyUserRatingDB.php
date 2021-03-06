<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotyfyUserRatingDB extends Notification
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
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {

        // $user = User::find($this->comment->user_id);
        // return [
        //     'data' => $this->comment,
        //     'url' => 'http://localhost:8000/study/' . $this->comment->study_id,
        //     'message' => "New comment on your Study Plan",
        //     'user' => $user,
        //     'title' => 'New Comment',
        //     'time' => $this->comment->created_at->diffForHumans()
        // ];
    }
}
