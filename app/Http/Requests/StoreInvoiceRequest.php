<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'invoice_number' => 'required|string|max:255',
            'invoice_Date' => 'required|date',
            'due_date' => 'required|date',
            'section' => 'required|exists:sections,id',
            'product' => 'required|exists:products,id',
            'Amount_collection' => 'nullable|numeric',
            'Amount_commission' => 'required|numeric',
            'discount' => 'nullable|string',
            'rate_vat' => 'required|in:5,10',
            'value_vat' => 'nullable|numeric',
            'total' => 'nullable|numeric',
            'description' => 'nullable|string',
            'file_name' => 'nullable|mimes:pdf,jpg,png,jpeg|max:2048',
        ];
    }
}
