<?php

namespace App\Notifications;
use Illuminate\Auth\Notifications\VerifyEmail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmailNotification extends VerifyEmail
{
    
    use Queueable;

    /**
     * Create a new notification instance.
     */


    public function __construct()
    {
       
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
   

    /**
     * Get the mail representation of the notification.
     */
    
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verify Your Email - Damietta IP Portal')
            ->greeting('Hello '.$notifiable->name.' 👋')
            ->line('Thank you for registering at Damietta IP Portal.')
            ->line('Please verify your email address to activate your account.')
            ->action('Verify Email', $verificationUrl)
            ->line('If you did not create this account, you can safely ignore this email.')
            ->salutation('Best Regards,'."\n".'Damietta IP Portal Team');
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
