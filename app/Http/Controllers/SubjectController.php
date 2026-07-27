<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::all();
        return view('manage_subjects', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create_subject');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_name' => 'required',
        ], [
            'subject_name.required' => 'Subject name is required',
        ]);

        $subjects = Subject::create(
            [
                'name' => $request->subject_name,
                'code' => $request->subject_code,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        return redirect()->route('subjects.create')->with('success', 'Subject Created Successfully');
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
        $subject = Subject::find($id);
        return view('edit_subject', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'subject_name' => 'required',
        ], [
            'subject_name.required' => 'Subject name is required',
        ]);


        $subject = Subject::findOrFail($id);
        $subject->update(
            [
                'name' => $request->subject_name,
                'code' => $request->subject_code,
            ]
        );
        return redirect()->route('subjects.edit', $id)->with('success', 'Subject Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subjects = Subject::find($id);
        $subjects->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject Deleted Successfully');
    }
}
