<?php

namespace App\Events;

use App\Models\Invoice;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InvoiceAddedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $invoiceId;
    public $created_at;
    public function __construct(Invoice $invoice)
    {
        $this->message = $invoice->id.'باضافه فاتوره جديده'.auth()->user()->name.'لقد قام ';
        $this->invoiceId =$invoice->id;
        $this->created_at = now();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('invoices-added'),
        ];
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'invoiceId' => $this->invoiceId,
            'date' => $this->created_at->format('Y-m-d H:i:s'), // Format date as required

        ];
    }
}
