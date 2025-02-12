<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OfferNotification extends Notification
{
    use Queueable;
    private $offerData;

    /**
     * Create a new notification instance.
     */
    public function __construct($offerData)
    {
        $this->offerData = $offerData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            // ->name($this->offerData['name'])
            ->subject($this->offerData['subject'])
            ->line($this->offerData['subject'])
            ->line($this->offerData['body'])
            ->action($this->offerData['offerText'], $this->offerData['offerUrl'])
            ->line("Thanks")
            ->from($this->offerData['email'],$this->offerData['name']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'data' => ' Your deposit of ' . $this->offerData['subject'] . ' was successful'
            //
        ];
    }
}
