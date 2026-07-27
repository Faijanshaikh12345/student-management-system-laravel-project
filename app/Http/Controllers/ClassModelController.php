<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;

class ClassModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = ClassModel::all();
        return view('manage_classes', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create_class');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',            
        ],[
            'name.required' => 'Class name is required',
        ]);
        
        ClassModel::create([
            'name' =>$request->name,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('class.create')->with('success', 'Class created successfully');
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
        $class  = ClassModel::findOrFail($id);
        return view('edit_class', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $request->validate([
            'name' => 'required',
       ],[
        'name.required' => 'Class name is required',
       ]);

       $class = ClassModel::find($id);
       $class->update([
            'name' => $request->name,
            'description' => $request->description,
       ]);

       return redirect()->route('class.edit' , $id)->with('success', 'Class Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $classes = ClassModel::find($id);
        $classes->delete();
        return redirect()->route('class.index')->with('success', 'Class deleted successfully');
    }
}
