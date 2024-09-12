<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvoiceUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;


class NotificationController extends Controller
{
    public function markAllAsRead()
    {
        InvoiceUpdate::where('seen', 0)->update(['seen' => 1]);
        return redirect()->back();
    }
    public function unreadNotificationsCount()
    {
        $count = InvoiceUpdate::where('seen', 0)->count();
        return response()->json($count);
    }

    public function MarkAsRead($invoiceId)
    {
        $notification = InvoiceUpdate::findOrFail($invoiceId);
        $notification->seen = 1;
        $notification->save();
        return redirect()->back();
    }
}
