<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<style>
/* Ensure the parent container is positioned relatively */
.nav-item.dropdown {
    position: relative;
}

/* Style for the bell icon */
.nav-item.dropdown .nav-link {
    position: relative;
    display: inline-flex;
    align-items: center;
}

/* Style for the notification indicator */
#notificationIndicatorForMessages {
    position: absolute; /* Position it relative to the .nav-link */
    top: -5px; /* Adjust as needed to position it above the icon */
    right: -5px; /* Adjust as needed to position it to the right of the icon */
    background-color: rgb(23, 25, 120); /* Color of the notification circle */
    color: white; /* Text color */
    border-radius: 75%; /* Make it a circle */
    width: 16px; /* Smaller size of the indicator */
    height: 16px; /* Smaller size of the indicator */
    text-align: center;
    line-height: 16px; /* Center text vertically */
    font-size: 10px; /* Smaller font size of the count */
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1051; /* Ensure it’s above other elements */
}

/* Hide the indicator when there are no notifications */
#notificationIndicatorForMessages.hidden {
    display: none;
}

/* Responsive adjustment */
@media (max-width: 768px) {
    #notificationIndicatorForMessages {
        width: 12px;
        height: 12px;
        font-size: 8px;
        top: -4px; /* Adjust for smaller size */
        right: -4px; /* Adjust for smaller size */
    }

}


</style>
<nav style="margin-bottom: 90px" class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <form id="sform" class="search-form">
            @csrf
            <div class="input-group">
                <div class="input-group-text">
                    <i data-feather="search"></i>
                </div>
                <input type="text" id="q" name="q" required="required" class="form-control" placeholder="Search here...">
            </div>
        </form>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="flag-icon flag-icon-us mt-1" title="us"></i> <span
                        class="ms-1 me-1 d-none d-md-inline-block">English</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="languageDropdown">
                    <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-us" title="us"
                            id="us"></i> <span class="ms-1"> English </span></a>
                    <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-fr" title="fr"
                            id="fr"></i> <span class="ms-1"> French </span></a>
                    <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-de" title="de"
                            id="de"></i> <span class="ms-1"> German </span></a>
                    <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-pt" title="pt"
                            id="pt"></i> <span class="ms-1"> Portuguese </span></a>
                    <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-es" title="es"
                            id="es"></i> <span class="ms-1"> Spanish </span></a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="appsDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="grid"></i>
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="appsDropdown">
                    <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                        <p class="mb-0 fw-bold">Web Apps</p>
                        <a href="javascript:;" class="text-muted">Edit</a>
                    </div>
                    <div class="row g-0 p-1">
                        <div class="col-3 text-center">
                            <a href="pages/apps/chat.html"
                                class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"><i
                                    data-feather="message-square" class="icon-lg mb-1"></i>
                                <p class="tx-12">Chat</p>
                            </a>
                        </div>
                        <div class="col-3 text-center">
                            <a href="pages/apps/calendar.html"
                                class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"><i
                                    data-feather="calendar" class="icon-lg mb-1"></i>
                                <p class="tx-12">Calendar</p>
                            </a>
                        </div>
                        <div class="col-3 text-center">
                            <a href="pages/email/inbox.html"
                                class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"><i
                                    data-feather="mail" class="icon-lg mb-1"></i>
                                <p class="tx-12">Email</p>
                            </a>
                        </div>
                        <div class="col-3 text-center">
                            <a href="#"
                                class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"><i
                                    data-feather="instagram" class="icon-lg mb-1"></i>
                                <p class="tx-12">Profile</p>
                            </a>
                        </div>
                    </div>
                    <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                        <a href="javascript:;">View all</a>
                    </div>
                </div>
            </li>


            @php
            $un_seen_notifications = App\Models\InvoiceUpdate::where('seen', 0)->count();
        @endphp
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i data-feather="bell"></i>
            <div class="indicator" id="notificationIndicatorForMessages" style="display: {{ $un_seen_notifications > 0 ? 'block' : 'none' }};">
                <span id="notificationCount">{{ $un_seen_notifications }}</span>
            </div>
        </a>
        @php
            $notifications = App\Models\InvoiceUpdate::where('seen', 0)->latest()->take(5)->get();
        @endphp
        <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
            <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                <p id="notification_unread_messages_count">Un Read Notifications</p>
            </div>
            <div id="notificationList">
                @foreach ($notifications as $notification)
                    <div class="p-1 notification_pusher">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('invoices_details', $notification->invoice_id) }}"
                                class="dropdown-item d-flex align-items-center py-2">
                                <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                    <i class="icon-sm text-white" data-feather="gift"></i>
                                </div>
                                <div class="flex-grow-1 me-2">
                                    <p>{{ @$notification->message }}</p>
                                    <p class="tx-12 text-muted">{{ $notification->created_at }}</p>
                                </div>
                            </a>
                            <!-- Small link to mark notification as read -->
                            <a href="{{ route('MarkNotificationsAsRead', $notification->id) }}"
                                class="text-muted" title="Mark as read">
                                <small>Mark as read</small>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                <a href="{{ route('markAllNotificationsAsRead') }}">Mark all as read</a>
            </div>
        </div>
    </li>


            @php
                $id = Auth::user()->id;
                $profiledata = App\Models\User::find($id);
            @endphp
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="wd-30 ht-30 rounded-circle"src="
                    {{ Auth()->user()->avatar }}
                     " alt="profile">
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">
                            <img class="wd-80 ht-80 rounded-circle"src="
                            {{ Auth()->user()->avatar }}
                             " alt="">
                        </div>
                        <div class="text-center">
                            <p class="tx-16 fw-bolder">
                                {{ Auth()->user()->name }}
                            </p>
                            <p class="tx-12 text-muted">
                                {{ Auth()->user()->email }}
                            </p>
                        </div>
                    </div>
                    <ul class="list-unstyled p-1">
                        <li class="dropdown-item py-2">
                            <a href="{{ route('admin_profile') }}" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="user"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li class="dropdown-item py-2">
                            <a href="" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="edit"></i>
                                <span>Edit Profile</span>
                            </a>
                        </li>
                        <li class="dropdown-item py-2">
                            <a href="javascript:;" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="repeat"></i>
                                <span>Switch User</span>
                            </a>
                        </li>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <li class="dropdown-item py-2">
                                <a href="#" :href="route('logout')"
                                    onclick="event.preventDefault();
                            this.closest('form').submit();"
                                    class="text-body ms-0">
                                    <i class="me-2 icon-md" data-feather="log-out"></i>
                                    <span>Log Out</span>
                                </a>
                            </li>
                        </form>

                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>

@push('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script>
      $(document).ready(function() {
            $('#q').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('auto_complete') }}",
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 1,
                select: function(event, ui) {
                    window.location.href = "{{ url('admin/invoice-details') }}/" + ui.item.value;
                }
            });
        });


                $(document).on('click', '.drop_down_for_messages', function() {
                    let indicator = $('.circle_messages');
                    indicator.removeClass();
                });


    </script>
@endpush
