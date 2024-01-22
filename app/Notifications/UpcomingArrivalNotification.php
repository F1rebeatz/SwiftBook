<?php

namespace App\Notifications;

use App\Events\UpcomingArrival;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpcomingArrivalNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected UpcomingArrival $event;

    public function __construct(UpcomingArrival $event)
    {
        $this->event = $event;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Upcoming Arrival Reminder')
            ->view('emails.upcoming-arrival', ['booking' => $this->event->booking]);
    }
}
