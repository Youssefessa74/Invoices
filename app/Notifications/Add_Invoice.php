<?php

namespace App\Notifications;

use App\Models\Invoice;
use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class Add_Invoice extends Notification
{
    use Queueable;

    protected $invoice;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */

    //  public function toArray($notifiable)
    //  {
    //      return [
    //          'invoice_id' => $this->invoice->id,
    //          'invoice_number' => $this->invoice->invoice_number,
    //          'invoice_date' => $this->invoice->invoice_Date,
    //          'total' => $this->invoice->total,
    //          'user' => Auth::user()->id,

    //          // Add other fields as needed
    //      ];
    //  }

     public function toBroadcast($notifiable)
     {
         return new BroadcastMessage([
            'invoice_id' => $this->invoice->id,
            'title' => 'تمت اضافه فاتوره جديده بواسطه',
            'invoice_number' => $this->invoice->invoice_number,
            'invoice_date' => $this->invoice->invoice_Date,
            'user' => Auth::user()->name,

             // Add other fields as needed
         ]);
     }

     public function broadcastOn()
{
    return new Channel('public-channel'); // Name the channel you defined
}


    //  public function toDatabase($notifiable)
    //  {
    //      return [
    //         'invoice_id' => $this->invoice->id,
    //          'title' => 'تمت اضافه فاتوره جديده بواسطه',
    //          'invoice_number' => $this->invoice->invoice_number,
    //          'invoice_date' => $this->invoice->invoice_Date,
    //          'user' => Auth::user()->name,
    //          // Add other fields as needed
    //      ];
    //  }
    // public function toArray(object $notifiable): array
    // {
    //     return [
    //         //
    //     ];
    // }
}
