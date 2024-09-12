<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function AutoComplete(Request $request)
    {
        $query = $request->get('term', '');
        $services = Invoice::where('invoice_number', 'LIKE', '%' . $query . '%')
            ->get(['invoice_number', 'id'])
            ->map(function ($item) {
                return [
                    'label' => $item->invoice_number,  // Displayed text
                    'value' => $item->id               // Hidden value, used for redirection
                ];
            })
            ->toArray();

        return response()->json($services);
    }

    public function SearchService(Request $request){
        $invoices_id = Str::slug($request->q,'-');
        if($invoices_id){
            return redirect("/services-details/".$invoices_id);
        }
    }
}
