<?php

namespace App\Listeners;

use App\Events\InvoiceAddedEvent;
use App\Models\InvoiceUpdate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InvoiceAddedListner
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(InvoiceAddedEvent $event): void
    {
        $notification = new InvoiceUpdate();
        $notification->message = $event->message;
        $notification->invoice_id = $event->invoiceId;
        $notification->save();

    }
}
