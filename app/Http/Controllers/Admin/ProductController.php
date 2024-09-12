<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $productDataTable)
    {
        return $productDataTable->render('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        return view('admin.products.create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => ['required', 'max:255'],
            'description' => ['nullable', 'max:1000'],
            'status' => ['required', 'boolean'],
            'section_id' => ['required', 'exists:sections,id'],
        ]);

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->section_id = $request->section_id;
        $product->save();

        toastr('Data Saved Successfully');
        return to_route('products.index');
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
        $sections = Section::all();
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('sections','product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate incoming request
        $request->validate([
            'product_name' => ['required', 'max:255'],
            'description' => ['nullable', 'max:1000'],
            'status' => ['required', 'boolean'],
            'section_id' => ['required', 'exists:sections,id'],
        ]);

        // Find the product by ID
        $product = Product::findOrFail($id);

        // Update the product with new data
        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->section_id = $request->section_id;
        $product->save();

        // Flash message for successful update
        toastr('Data Updated Successfully');

        // Redirect to the products index route
        return to_route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
