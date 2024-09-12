@extends('admin.body.dashboard')
@section('content')
<div class="page-content">

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
        </div>

    </div>

    <div class="row">
            <!-- Total Users -->
<div class="col-md-4 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">جميع المستخدمين</h6>
                <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                </div>
            </div>
            <div class="d-flex">
                <div class="flex-grow-1">
                    <h3 class="mb-2">{{ $totalUsers }}</h3>
                    <p class="text-success">
                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Total Admin -->
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">جميع الادمن</h6>
                    <div class="dropdown mb-2">
                        <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                        </a>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <h3 class="mb-2">{{ $totalAdmins }}</h3>
                        <p class="text-success">
                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Total Sections -->
<div class="col-md-4 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">الاقسام</h6>
                <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                </div>
            </div>
            <div class="d-flex">
                <div class="flex-grow-1">
                    <h3 class="mb-2">{{ $totalSections }}</h3>
                    <p class="text-success">
                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Total Products -->
<div class="col-md-4 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">المنتجات</h6>
                <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                </div>
            </div>
            <div class="d-flex">
                <div class="flex-grow-1">
                    <h3 class="mb-2">{{ $totalProducts }}</h3>
                    <p class="text-success">
                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Total Invoices -->
<div class="col-md-4 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">جميع الفواتير</h6>
                <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                </div>
            </div>
            <div class="d-flex">
                <div class="flex-grow-1">
                    <h3 class="mb-2">{{ $totalInvoices }}</h3>
                    <p class="text-success">
                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Total Amount -->
<div class="col-md-4 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">المجمل من جميع الفواتير</h6>
                <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                </div>
            </div>
            <div class="d-flex">
                <div class="flex-grow-1">
                    <h3 class="mb-2">{{ number_format($totalAmount, 2) }}</h3>
                    <p class="text-success">
                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Total Amount Collected -->
<div class="col-md-4 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">المجمل من جميع الفواتير التي تم جمعها</h6>
                <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                </div>
            </div>
            <div class="d-flex">
                <div class="flex-grow-1">
                    <h3 class="mb-2">{{ number_format($totalAmountCollected, 2) }}</h3>
                    <p class="text-success">
                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Total Commission -->
<div class="col-md-4 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">مجمل العموله</h6>
                <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                </div>
            </div>
            <div class="d-flex">
                <div class="flex-grow-1">
                    <h3 class="mb-2">{{ number_format($totalCommission, 2) }}</h3>
                    <p class="text-success">
                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Invoice Status Summary -->
<div class="col-md-4 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">حالات جميع الفواتير</h6>
                <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                </div>
            </div>
            <div class="d-flex flex-column">
                <p>الغير مدفوعه: {{ $pendingInvoices }}</p>
                <p>المدفوعه: {{ $paidInvoices }}</p>
                <p>المدفوعه جزئيا: {{ $partiallyPaidInvoices }}</p>
            </div>
        </div>
    </div>
</div>

@endsection
