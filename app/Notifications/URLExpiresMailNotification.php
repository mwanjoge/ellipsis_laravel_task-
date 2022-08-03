<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class URLExpiresMailNotification extends Notification
{
    use Queueable;
    private $url;
    private $dateExpires;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($url,$dateExpires)
    {
        $this->url = $url;
        $this->dateExpires = $dateExpires;
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
        return (new MailMessage)
                    ->line($this->url)
                    ->line('The short url you created is set to expire in')
                    ->line($this->dateExpires)
                    ->line('Thank you for using our application');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
