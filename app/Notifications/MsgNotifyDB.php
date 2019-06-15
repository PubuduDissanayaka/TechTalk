<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MsgNotifyDB extends Notification
{
    use Queueable;
    public $chat;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->chat = $chat;
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
    public function toArray($notifiable)
    {

        $user = User::find($this->chat->friend_id);

        return [
            'data' => $this->chat,
            'url' => 'http://localhost:8000/chat/' . $this->chat->friend_id,
            'message' => "New message received",
            'user' => $user,
            'title' => 'New Comment',
            'time' => $this->chat->created_at->diffForHumans()
        ];
    }
}
