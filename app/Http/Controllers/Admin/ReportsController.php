<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function Reports(){
        return view('admin.reports.index');
    }

    public function SearchReports(Request $request)
    {
        $query = Invoice::query();

        // Check if request parameters are set
        if ($request->rdio == '2') {
            // Search by invoice number
            if ($request->has('invoice_number') && !empty($request->invoice_number)) {
                $query->where('invoice_number', $request->invoice_number);
            }
        } else {
            // Search by type and date range
            if ($request->has('type') && !empty($request->type)) {
                $query->where('invoice_status', $request->type);
            }

            if ($request->has('start_at') && !empty($request->start_at)) {
                $query->whereDate('invoice_Date', '>=', $request->start_at);
            }

            if ($request->has('end_at') && !empty($request->end_at)) {
                $query->whereDate('invoice_Date', '<=', $request->end_at);
            }
        }

        // Retrieve the filtered results
        $details = $query->get();

        // Pass the request parameters for form repopulation if needed
        return view('admin.reports.index', compact('details', 'request'));
    }

    public function ClientReports(){
        $sections = Section::all();
        $products = []; // Initialize with an empty arrayin
        // Pass data to the view
        return view('admin.reports.client_reports', compact('sections', 'products'));
    }

    public function ProductsBelongsToSections(Request $request){

        $id = $request->section_id;
        $products = Product::where('section_id',$id)->pluck('product_name','id');
        return response()->Json($products);
    }

    public function SearchReportsByClients(Request $request)
    {
        $query = Invoice::query();

        // Apply filters based on request
        if ($request->has('section') && !empty($request->section)) {
            $query->where('section_id', $request->section);
        }

        if ($request->has('products') && !empty($request->products)) {
            $query->where('product_id', $request->products);
        }

        if ($request->has('start_at') && !empty($request->start_at)) {
            $query->whereDate('invoice_Date', '>=', $request->start_at);
        }

        if ($request->has('end_at') && !empty($request->end_at)) {
            $query->whereDate('invoice_Date', '<=', $request->end_at);
        }

        // Retrieve the filtered results
        $details = $query->get();

        // Fetch sections for dropdown
        $sections = Section::all();

        // Initialize products array
        $products = [];

        // Fetch products based on the selected section
        if ($request->has('section') && !empty($request->section)) {
            $selectedSection = $request->input('section');
            $products = Product::where('section_id', $selectedSection)->pluck('product_name', 'id');
        }

        // Pass data to the view
        return view('admin.reports.client_reports', [
            'details' => $details,
            'sections' => $sections,
            'products' => $products,
            'request' => $request
        ]);
    }





}
