<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

<!-- Optional: include Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ url('/') }}" class="sidebar-brand">
            Banks<span>Invoices</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-category">Project</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#users" role="button" aria-expanded="false" aria-controls="users">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Management</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="users">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link">All Users</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('role.index') }}" class="nav-link">All Roles</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('permission.index') }}" class="nav-link">All Permissions</a>
                        </li>
                    </ul>
                </div>
            </li>

            @can('view invoices')
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#invoices" role="button" aria-expanded="false" aria-controls="invoices">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Invoices</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="invoices">
                    <ul class="nav sub-menu">

                        <li class="nav-item">
                            <a href="{{ route('invoices.index') }}" class="nav-link">All Invoices</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pending_invoices') }}" class="nav-link">Pending Invoices</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('paid_invoices') }}" class="nav-link">Paid Invoices</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('partially_paid_invoices') }}" class="nav-link">Partially Paid Invoices</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('trashed_invoices') }}" class="nav-link">Trashed Invoices</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.index') }}" class="nav-link">Reports</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('client_reports') }}" class="nav-link">Client Reports</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endcan

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#section" role="button" aria-expanded="false" aria-controls="section">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Settings</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="section">
                    <ul class="nav sub-menu">
                        @can('view sections')
                        <li class="nav-item">
                            <a href="{{ route('sections.index') }}" class="nav-link">Sections</a>
                        </li>
                        @endcan
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}" class="nav-link">Products</a>
                        </li>
                    </ul>
                </div>
            </li>



            <li class="nav-item nav-category">Components</li>


            </li>
            <li class="nav-item nav-category">Docs</li>
            <li class="nav-item">
                <a href="https://www.nobleui.com/html/documentation/docs.html" target="_blank" class="nav-link">
                    <i class="link-icon" data-feather="hash"></i>
                    <span class="link-title">Documentation</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
<nav class="settings-sidebar">
    <div class="sidebar-body">

        <div class="theme-wrapper">
            <h6 class="text-muted mb-2">Light Theme:</h6>
            <a class="theme-item" href="../demo1/dashboard.html">
                <img src="../assets/images/screenshots/light.jpg" alt="light theme">
            </a>
            <h6 class="text-muted mb-2">Dark Theme:</h6>
            <a class="theme-item active" href="../demo2/dashboard.html">
                <img src="../assets/images/screenshots/dark.jpg" alt="light theme">
            </a>
        </div>
    </div>
</nav>
