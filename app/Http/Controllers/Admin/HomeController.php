<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        // Fetch total Users
        $totalUsers = User::count();

        // Fetch total Admins
        $totalAdmins = User::where('role', '!=', 'user')->count();

        // Fetch total sections
        $totalSections = Section::count();

        // Fetch total products
        $totalProducts = Product::count();

        // Fetch total invoices
        $totalInvoices = Invoice::count();

        // Fetch total amount from invoices (e.g., total sales amount)
        $totalAmount = Invoice::sum('total');

        // Fetch total amount collected (if applicable)
        $totalAmountCollected = Invoice::sum('Amount_collection');

        // Fetch total amount commission
        $totalCommission = Invoice::sum('Amount_commission');

        // Fetch the number of pending, paid, and partially paid invoices
        $pendingInvoices = Invoice::where('invoice_status', 'pending')->count();
        $paidInvoices = Invoice::where('invoice_status', 'paid')->count();
        $partiallyPaidInvoices = Invoice::where('invoice_status', 'partially_paid')->count();

        // Pass data to the view
        return view('admin.index', compact(
            'totalUsers',
            'totalAdmins',
            'totalSections',
            'totalProducts',
            'totalInvoices',
            'totalAmount',
            'totalAmountCollected',
            'totalCommission',
            'pendingInvoices',
            'paidInvoices',
            'partiallyPaidInvoices'
        ));
    }
}
