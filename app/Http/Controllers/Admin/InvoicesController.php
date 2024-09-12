<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DeletedInvoicesDataTable;
use App\DataTables\InvoiceDataTable;
use App\DataTables\PaidInvoicesDataTable;
use App\DataTables\Partially_PaidDataTable;
use App\DataTables\PendingInvoicesDataTable;
use App\Events\InvoiceUpdateEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoice;
use App\Models\InvoiceAttachment;
use App\Models\InvoiceDetails;
use App\Models\Product;
use App\Models\Section;
use App\Models\User;
use App\Notifications\Add_Invoice;
use App\Services\InvoiceService;
use App\Traits\upload_file;
use App\Traits\upload_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class InvoicesController extends Controller
{
    use upload_file;
    protected $invoiceService;


    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(InvoiceDataTable $invoiceDataTable)
    {
        return $invoiceDataTable->render('admin.invoices.index');
    }

    public function PendingInvoices(PendingInvoicesDataTable $invoiceDataTable)
    {
        return $invoiceDataTable->render('admin.invoices.pending_invoices');
    }

    public function PartiallyPaidInvoices(Partially_PaidDataTable $invoiceDataTable)
    {
        return $invoiceDataTable->render('admin.invoices.partially_paid');
    }
    public function PaidInvoices(PaidInvoicesDataTable $invoiceDataTable)
    {
        return $invoiceDataTable->render('admin.invoices.paid_invoices');
    }
    public function TrashedInvoices()
    {
        $invoices = Invoice::onlyTrashed()->paginate(10);
        return view('admin.invoices.trashed_invoices',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections =  Section::all();
        $products = Product::all();
        return view('admin.invoices.create', compact('products', 'sections'));
    }

    public function store(StoreInvoiceRequest $request)
    {
        try {
            $validated = $request->validated();
            $this->invoiceService->storeInvoice($validated, $request);
            // $user = User::get();
            // $user->notify(new Add_Invoice());
            toastr('Data Saved Successfully', 'success');
            return redirect()->route('invoices.index');
        } catch (\Exception $e) {
            toastr('An error occurred: ' . $e->getMessage(), 'error');
            return back()->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = Invoice::with(['details', 'attachments'])->findOrFail($id);
        $sections =  Section::all();
        $products = Product::all();
        return view('admin.invoices.edit', compact('invoice', 'products', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, $id)
    {
        try {
            // Retrieve the invoice to be updated
            $invoice = Invoice::findOrFail($id);

            // Get the validated data
            $validated = $request->validated();

            // Pass the invoice and request to the service for updating
            $this->invoiceService->updateInvoice($invoice, $validated, $request);

            toastr('Data Updated Successfully', 'success');
            return redirect()->route('invoices.index');
        } catch (\Exception $e) {
            toastr('An error occurred: ' . $e->getMessage(), 'error');
            return back()->withInput();
        }
    }


    public function DeleteInvoice(string $id)
    {
        try {
            // Find the invoice or fail
            $invoice = Invoice::findOrFail($id);

            // Find related attachments and details
            $invoice_attachments = InvoiceAttachment::where('invoice_id', $invoice->id)->get();
            $invoice_details = InvoiceDetails::where('invoice_id', $invoice->id)->get();

            // Delete each attachment's file
            foreach ($invoice_attachments as $attachment) {
                $this->removeFile($attachment->file_name);
            }

            // Delete related records
            $invoice_details->each->delete();
            $invoice_attachments->each->delete();
            $invoice->delete();

            // Success message
            toastr('Invoice and related data deleted successfully', 'success');
            return redirect()->route('invoices.index');
        } catch (\Exception $e) {
            // Log the exception message and return a user-friendly error
            Log::error('Error deleting invoice: ' . $e->getMessage());
            toastr('An error occurred while deleting the invoice. Please try again later.', 'error');
            return redirect()->route('invoices.index');
        }
    }


    public function GetProducts(Request $request)
    {
        $products = Product::where('section_id', $request->section_id)->pluck('product_name', 'id');
        return response()->json($products);
    }

    public function invoices_details($id)
    {
        $invoice = Invoice::with(['details', 'attachments'])->findOrFail($id);
        return view('admin.invoices.show', compact('invoice'));
    }

    public function deleteAttachment(Invoice $invoiceId, $attachmentId)
    {
        try {
            $attachment = $invoiceId->attachments()->findOrFail($attachmentId);

            // Delete the file from the server
            if (File::exists(public_path($attachment->file_name))) {
                File::delete(public_path($attachment->file_name));
            }

            // Delete the attachment record from the database
            $attachment->delete();
            return response(['status' => 'success', 'message' => 'Attachment Deleted Successfully'], 200);
        } catch (\Exception $e) {
            toastr('An error occurred: ' . $e->getMessage(), 'error');
        }

        return redirect()->route('invoices.show', $invoiceId->id);
    }

    public function forceDelete($id)
    {
        // Find the soft-deleted invoice by its ID
        $invoice = Invoice::withTrashed()->findOrFail($id);

        // Permanently delete the invoice
        $invoice->forceDelete();

        // Redirect or respond with a success message
        toastr('Invoice permanently deleted.');
        return redirect()->route('trashed_invoices');
    }

    public function InvoiceChangeStatus($id, Request $request)
    {
        $request->validate([
            'invoice_status' => ['required', 'in:pending,paid,partially_paid'],
        ]);
        $invoice =  Invoice::findOrFail($id);
        $invoice->invoice_status = $request->invoice_status;
        $invoice->save();
        InvoiceUpdateEvent::dispatch($invoice);
        toastr('Invoice Status Updated Successfully');
        return redirect()->back();
    }
}
