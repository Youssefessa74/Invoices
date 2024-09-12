<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SectionDataTable;
use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SectionDataTable $sectionDataTable)
    {
        return $sectionDataTable->render('admin.sections.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','max:255','unique:sections,name'],
            'description' => ['nullable','max:1000'],
            'status' => ['boolean','required']
        ]);

        $section = new Section();
        $section->name = $request->name;
        $section->description = $request->description;
        $section->status = $request->status;
        $section->created_by = Auth::user()->id;
        $section->save();
        toastr('Data Saved Successfully');
        return to_route('sections.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
          $section = Section::findOrFail($id);
        return view('admin.sections.edit',compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required','max:255','unique:sections,name,'.$id],
            'description' => ['nullable','max:1000'],
            'status' => ['boolean','required']
        ]);

        $section = Section::findOrFail($id);
        $section->name = $request->name;
        $section->description = $request->description;
        $section->status = $request->status;
        $section->created_by = Auth::user()->id;
        $section->save();
        toastr('Data Saved Successfully');
        return to_route('sections.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $section = Section::findOrFail($id);
        $section->delete();
        toastr('Data Saved Successfully');
        return to_route('sections.index');
    }

    }

