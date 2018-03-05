<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ChangeOrderStatus extends Notification
{
    use Queueable;

    protected $order;
    protected $user;
    protected $dish;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order,)
    {
        $this->order = $order;

         $this->user = User::select('id','fname','lname')->where('id', $order->user_id)->get();

        $this->dish = Dish::select('did','dish_name')->where('did', $order->dish_id)->get();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return[
            'order' => $this->order,
            'user' => $this->user,
            'dish' => $this->dish
        ];
        // dd($this->user);
    }

    public function toBroadcast($notifiable)
    {

        return new BroadcastMessage([
            'order' => $this->order,
            'user' => $this->user,
            'dish' => $this->dish
        ]);
        // dd($this->user);
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
