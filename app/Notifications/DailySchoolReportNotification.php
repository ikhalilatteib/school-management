<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DailySchoolReportNotification extends Notification
{
    use Queueable;

    private $schools;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct($schools)
    {
        //
        $this->schools = $schools;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('The list of schools registered yesterday.')
                   ->view('mail.daily-school-record',['schools'=>$this->schools]);
    }

}
