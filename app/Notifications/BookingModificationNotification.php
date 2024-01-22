<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingModificationNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected Booking $booking;
    protected string $modificationType;

    public function __construct(Booking $booking, string $modificationType)
    {
        $this->booking = $booking;
        $this->modificationType = $modificationType;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Booking Modification')
            ->view('emails.booking-modification', ['booking' => $this->booking, 'modificationType' => $this->modificationType]);
    }
}
