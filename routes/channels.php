<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('public-channel', function ($user) {
    return true; // Allow access to everyone for public channels
});

Broadcast::channel('invoices-updated', function ($user) {
    return in_array($user->role_name, ['admin', 'super_admin', 'manager']);
});

Broadcast::channel('invoices-added', function ($user) {
    return in_array($user->role_name, ['admin', 'super_admin', 'manager']);
});
