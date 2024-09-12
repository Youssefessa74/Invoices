import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

import Echo from "laravel-echo";

import Pusher from "pusher-js";
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: PusherKey,
    cluster: PusherCluster ?? "mt1",
    wsHost: import.meta.env.VITE_PUSHER_HOST
        ? import.meta.env.VITE_PUSHER_HOST
        : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? "https") === "https",
    enabledTransports: ["ws", "wss"],
});


window.Echo.channel('invoices-updated').listen('InvoiceUpdateEvent', (event) => {
    // Prepare the HTML for the new notification
    let html = `
    <div class="p-1 notification_pusher">
        <div class="d-flex align-items-center justify-content-between">
            <a href="/admin/invoice-details/${event.invoiceId}" class="dropdown-item d-flex align-items-center py-2">
                <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                    <i class="icon-sm text-white" data-feather="gift"></i>
                </div>
                <div class="flex-grow-1 me-2">
                    <p>${event.message}</p>
                    <p class="tx-12 text-muted">${event.date}</p>
                </div>
            </a>
            <!-- Small link to mark notification as read -->
            <a href="/admin/mark-notifications-as-read/${event.invoiceId}" class="text-muted" title="Mark as read">
                <small>Mark as read</small>
            </a>
        </div>
    </div>
`;

// Update notification list
$("#notificationList").prepend(html);


    // Update notification count
    let countElem = $("#notificationCount");
    let currentCount = parseInt(countElem.text());
    countElem.text(currentCount + 1);

    // Show notification indicator if it's hidden
    $("#notificationIndicatorForMessages").show();
});


window.Echo.channel('invoices-added').listen('InvoiceAddedEvent', (event) => {
    // Prepare the HTML for the new notification
    console.log(event);
    let html = `
    <div class="p-1 notification_pusher">
        <div class="d-flex align-items-center justify-content-between">
            <a href="/admin/invoice-details/${event.invoiceId}" class="dropdown-item d-flex align-items-center py-2">
                <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                    <i class="icon-sm text-white" data-feather="gift"></i>
                </div>
                <div class="flex-grow-1 me-2">
                    <p>${event.message}</p>
                    <p class="tx-12 text-muted">${event.date}</p>
                </div>
            </a>
            <!-- Small link to mark notification as read -->
            <a href="/admin/mark-notifications-as-read/${event.invoiceId}" class="text-muted" title="Mark as read">
                <small>Mark as read</small>
            </a>
        </div>
    </div>
`;

// Update notification list
$("#notificationList").prepend(html);


    // Update notification count
    let countElem = $("#notificationCount");
    let currentCount = parseInt(countElem.text());
    countElem.text(currentCount + 1);

    // Show notification indicator if it's hidden
    $("#notificationIndicatorForMessages").show();
});


