<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingConfirmed extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Your booking has been confirmed!')
                    ->action('View Booking', url('/bookings/'.$this->booking->id))
                    ->line('Thank you for using AWISH RENTALS!');
    }

    public function toArray($notifiable): array
    {
        return [
            'booking_id' => $this->booking->id,
            'message' => 'Your booking for '.$this->booking->bookable->title.' has been confirmed.',
        ];
    }
}
