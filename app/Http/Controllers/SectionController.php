<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::with('class')->get();
        return view('manage_sections', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = ClassModel::all();
        return view('create_section', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'class_id' => 'required',
        ], [
            'name.required' => 'Section name is required',
            'class_id.required' => 'Please Select Class Name',
        ]);


        $sections = Section::create([
            'name' => $request->name,
            'class_id' => $request->class_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('sections.create')->with('success', 'Section created successfully');
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
        $sections = section::find($id);
        $classes = ClassModel::all();
        return view('edit_section', compact('sections', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'class_id' => 'required',
        ], [
            'name.required' => 'Section name is required',
            'class_id.required' => 'Please Select Class Name',
        ]);


        $sections = Section::find($id);
        $sections->update([
            'name' => $request->name,
            'class_id' => $request->class_id,
        ]);

        return redirect()->route('sections.edit' ,$id)->with('success', 'Section Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sections = Section::find($id);
        $sections->delete();
        return redirect()->route('sections.index')->with('success', 'Section deleted successfully');
    }
}
