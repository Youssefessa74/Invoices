<?php

use App\Events\InvoiceUpdateEvent;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\InvoicesController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\RolePermission\PermissionController;
use App\Http\Controllers\Admin\RolePermission\RoleController;
use App\Http\Controllers\Admin\RolePermission\UserController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ProfileController;
use App\Models\Invoice;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', function () {
        return 'Hi Admin';
    })->name('admin.dashboard');
    Route::get('home', [HomeController::class, 'home'])->name('home');


    // Profile Routes
    Route::controller(ProfileController::class)->group(function () {
        Route::get('admin-profile-all', 'index')->name('admin_profile');
        Route::post('edit-profile', 'EditProfile')->name('admin.profile.edit');
        Route::post('admin-change-password', 'changePassword')->name('admin.change_password');
    });



    Route::resource('invoices', InvoicesController::class);
    Route::resource('sections', SectionController::class);
    Route::resource('products', ProductController::class);

    // Invoices Action Route
    Route::get('section-products', [InvoicesController::class, 'GetProducts'])->name('get_products');
    Route::get('invoice-details/{id}', [InvoicesController::class, 'invoices_details'])->name('invoices_details');
    Route::delete('invoices/{invoiceId}/attachments/{attachmentId}', [InvoicesController::class, 'deleteAttachment'])->name('attachments.delete');
    Route::get('delete-invoice/{id}', [InvoicesController::class, 'DeleteInvoice'])->name('delete_invoice');
    Route::post('invoice-change-status/{id}', [InvoicesController::class, 'InvoiceChangeStatus'])->name('invoice_change_status');
    Route::get('pending-invoices', [InvoicesController::class, 'PendingInvoices'])->name('pending_invoices');
    Route::get('paid-invoices', [InvoicesController::class, 'PaidInvoices'])->name('paid_invoices');
    Route::get('partially-paid-invoices', [InvoicesController::class, 'PartiallyPaidInvoices'])->name('partially_paid_invoices');
    Route::get('trashed-invoices', [InvoicesController::class, 'TrashedInvoices'])->name('trashed_invoices');
    Route::get('force-delete-invoice/{id}', [InvoicesController::class, 'forceDelete'])->name('force_delete');
    ///////////////////////////////////////////////////////////////////
    // Users Routes
    Route::controller(UserController::class)->group(function () {
        Route::get('users', 'index')->name('user.index');
        Route::get('user-create', 'create')->name('user.create');
        Route::post('user-store', 'store')->name('user.store');
        Route::get('users-delete/{id}', 'destroy')->name('user.destroy');

    });

    // Roles Routes
    Route::controller(RoleController::class)->group(function () {
        Route::get('roles-permissions', 'index')->name('role.index');
        Route::get('roles-permissions-create', 'create')->name('role.create');
        Route::post('roles-permissions-store', 'store')->name('role.store');
        Route::get('roles-permissions-edit/{roleId}', 'edit')->name('role.edit');
        Route::put('roles-permissions-update/{roleId}', 'update')->name('role.update');
    });

    // Roles Routes
    Route::controller(PermissionController::class)->group(function () {
        Route::get('permissions', 'index')->name('permission.index');
        Route::get('permissions-create', 'create')->name('permission.create');
        Route::post('permissions-store', 'store')->name('permission.store');
        Route::get('permissions-delete/{id}', 'destroy')->name('permission.destroy');
    });


    // Roles Routes
    Route::controller(ReportsController::class)->group(function () {
        Route::get('reports', 'Reports')->name('reports.index');
        Route::get('search-reports', 'SearchReports')->name('search_reports');
        Route::get('clients-reports', 'ClientReports')->name('client_reports');
        Route::get('products-belongs-section', 'ProductsBelongsToSections')->name('products_belongs_section');
        Route::get('search-reports-by-clients', 'SearchReportsByClients')->name('search_reports_by_clients');
    });



    // web.php (routes file)
    Route::get('/admin/mark-notifications-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('MarkNotificationsAsRead');
    Route::get('/admin/unread-notifications-count', [NotificationController::class, 'unreadNotificationsCount']);
    Route::get('/admin/mark-all-notifications-as-read', [NotificationController::class, 'markAllAsRead'])->name('markAllNotificationsAsRead');


    // Settings Routes
    Route::controller(SettingController::class)->group(function () {
        Route::get('/settings', 'index')->name('settings');
        Route::put('/settings-pusher-update', 'PusherUpdate')->name('settings_pusher_update');
    });

    // Search Routes
    Route::controller(SearchController::class)->group(function () {
        Route::get('auto-compelete', 'AutoComplete')->name('auto_complete');
    });
});
