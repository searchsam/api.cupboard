<?php

namespace App\Notifications;

use App\Mail\NewOrderCreated as Mailable;
use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class OrderCreated extends Notification implements ShouldQueue
{

    use Queueable;

    /**
     * The order instance.
     *
     * @var Order
     */
    public $order;

    /**
     * Create a new notification instance.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return Mailable as Mailable
     */
    public function toMail($notifiable)
    {
        return (new Mailable($this->order))->to($notifiable->email);
    }
}
