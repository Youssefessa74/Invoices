<?php

namespace App\Services;

use App\Events\InvoiceAddedEvent;
use App\Events\InvoiceUpdateEvent;
use App\Models\Invoice;
use App\Models\InvoiceDetails;
use App\Models\InvoiceAttachment;
use App\Models\User;
use App\Notifications\Add_Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Correctly import File facade
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class InvoiceService
{

    public function storeInvoice($validatedData, Request $request)
    {
        DB::beginTransaction();

        try {
            // Create an invoice
            $invoice = Invoice::create([
                'invoice_number' => $validatedData['invoice_number'],
                'invoice_Date' => $validatedData['invoice_Date'],
                'due_date' => $validatedData['due_date'],
                'product_id' => $validatedData['product'],
                'section_id' => $validatedData['section'],
                'discount' => $validatedData['discount'],
                'rate_vat' => $validatedData['rate_vat'],
                'value_vat' => $validatedData['value_vat'] ?? 0,
                'total' => $validatedData['total'] ?? 0,
                'Amount_commission' => $validatedData['Amount_commission'],
                'Amount_collection' => $validatedData['Amount_collection'],
                'invoice_status' => 'pending',
                'note' => $validatedData['description'],
                'user_id' => auth()->id(),
            ]);

            // Create invoice details
            InvoiceDetails::create([
                'invoice_id' => $invoice->id,
                'product' => $validatedData['product'],
                'section' => $validatedData['section'],
                'status' => 'pending',
                'note' => $validatedData['description'],
                'user' => auth()->user()->name,
            ]);

            // Handle file upload if present
            $file = $request->file('file_name');
            $attachmentPath = $this->uploadFile($file, 'uploads/invoices'); // Adjusted to use the trait method

            if ($attachmentPath) {
                InvoiceAttachment::create([
                    'file_name' => $attachmentPath,
                    'invoice_number' => $validatedData['invoice_number'],
                    'invoice_id' => $invoice->id,
                ]);
            }

            // Commit transaction
            DB::commit();
            InvoiceAddedEvent::dispatch($invoice);
            return true;
        } catch (\Exception $e) {
            // Rollback transaction
            DB::rollBack();
            throw $e; // Rethrow the exception to be handled in the controller
        }
    }

    public function updateInvoice(Invoice $invoice, array $validatedData, Request $request)
    {
        DB::beginTransaction();

        try {
            // Update invoice details
            $invoice->update([
                'invoice_number' => $validatedData['invoice_number'],
                'invoice_Date' => $validatedData['invoice_Date'],
                'due_date' => $validatedData['due_date'],
                'product_id' => $validatedData['product'],
                'section_id' => $validatedData['section'],
                'discount' => $validatedData['discount'],
                'rate_vat' => $validatedData['rate_vat'],
                'value_vat' => $validatedData['value_vat'] ?? 0,
                'total' => $validatedData['total'] ?? 0,
                'Amount_commission' => $validatedData['Amount_commission'],
                'Amount_collection' => $validatedData['Amount_collection'],
                'note' => $validatedData['description'],
            ]);

            // Update invoice details
            $invoiceDetails = InvoiceDetails::where('invoice_id', $invoice->id)->first();
            if ($invoiceDetails) {
                $invoiceDetails->update([
                    'product' => $validatedData['product'],
                    'section' => $validatedData['section'],
                    'status' => 'pending',
                    'note' => $validatedData['description'],
                    'user' => auth()->user()->name,
                ]);
            }

            // Handle file upload if present
            if ($request->hasFile('file_name')) {
                // Delete old file if it exists
                if ($invoice->attachment && File::exists(public_path($invoice->attachment->file_name))) {
                    File::delete(public_path($invoice->attachment->file_name));
                }

                // Upload new file
                $file = $request->file('file_name');
                $attachmentPath = $this->uploadFile($file, 'uploads/invoices');

                // Update or create invoice attachment
                if ($attachmentPath) {
                    // Update existing attachment or create a new one if it doesn’t exist
                    $attachment = $invoice->attachment;
                    if ($attachment) {
                        $attachment->update([
                            'file_name' => $attachmentPath,
                            'invoice_number' => $validatedData['invoice_number'],
                            'invoice_id' => $invoice->id,
                        ]);
                    } else {
                        InvoiceAttachment::create([
                            'file_name' => $attachmentPath,
                            'invoice_number' => $validatedData['invoice_number'],
                            'invoice_id' => $invoice->id,
                        ]);
                    }
                }
            }

            // Commit transaction
            DB::commit();

            return true;
        } catch (\Exception $e) {
            // Rollback transaction
            DB::rollBack();
            throw $e; // Rethrow the exception to be handled in the controller
        }
    }

    private function uploadFile($file, $path)
    {
        if (!$file || !$file->isValid()) {
            Log::error("Invalid file upload.");
            return null; // Return null if the file is invalid or not provided
        }

        $fileName = 'media_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $fullPath = public_path($path);

        // Ensure the directory exists
        if (!File::exists($fullPath)) {
            File::makeDirectory($fullPath, 0755, true, true);
        }

        try {
            $file->move($fullPath, $fileName);
        } catch (\Exception $e) {
            Log::error("File upload error: " . $e->getMessage());
            return null; // Return null if upload fails
        }

        return $path . '/' . $fileName;
    }


    private function removeFile($path)
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
