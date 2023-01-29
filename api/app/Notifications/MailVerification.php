<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailVerification extends Notification
{
    use Queueable;

    /**
     * @construct
     */
    public function __construct()
    {
        //
    }

    /**
     * @param $notifiable
     * @return string[]
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * @param $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Flight World Email Verification')
            ->greeting('Hi ' . $notifiable->name . ', ')
            ->line('you\'re almost ready to start enjoying Flight World.')
            ->line('Simply click the big button bellow to verify your email address.')
            ->action('Verify email address', url(route('account.activation', [
                'activationCode' => $notifiable->verification_code
            ])));
    }
}
