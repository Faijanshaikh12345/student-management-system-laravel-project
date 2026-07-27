<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\SubjectAssignment;
use Illuminate\Http\Request;

class SubjectAssignmentController extends Controller
{

    public function getSections($class_id)
    {
        $sections = Section::where('class_id', $class_id)
            ->select('id', 'name')
            ->get();

        return response()->json($sections);
    }

    public function index()
    {
        $subjectAssignments = SubjectAssignment::with(['teacher', 'subject', 'class', 'section'])->get();
        return view('manage_subject_assignments', compact('subjectAssignments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = ClassModel::all();
        $sections = Section::all();
        $teachers = Teacher::all();
        $subjects = Subject::all();
        return view('create_subject_assignment', compact('classes', 'sections', 'teachers', 'subjects'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required',
            'subject_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
        ], [
            'teacher_id.required' => 'Please Select Teacher Name',
            'subject_id.required' => 'Please Select Subject',
            'class_id.required' => 'Please Select Class',
            'section_id.required' => 'Please Select Section',
        ]);

        $subjectAssignments = SubjectAssignment::create([
            'teacher_id' => $request->teacher_id,
            'subject_id' => $request->subject_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
        ]);

        return redirect()->route('subjectAssignments.create')->with('success', 'Subject Assignment Successfully');
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

    public function edit($id)
    {
        $assignment = SubjectAssignment::findOrFail($id);

        $classes  = ClassModel::all();
        $teachers = Teacher::all();
        $subjects = Subject::all();

        // Only sections of selected class
        $sections = Section::where('class_id', $assignment->class_id)->get();

        return view('edit_subject_assignment', compact(
            'assignment',
            'classes',
            'teachers',
            'subjects',
            'sections'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'teacher_id' => 'required',
            'subject_id' => 'required',
            'class_id'   => 'required',
            'section_id' => 'required',
        ],[
            'teacher_id.required' => 'Please Select Teacher Name',
            'subject_id.required' => 'Please Select Subject',
            'class_id.required'   => 'Please Select Class',
            'section_id.required' => 'Please Select Section',
        ]);

        $assignment = SubjectAssignment::findOrFail($id);

        $assignment->update([
            'teacher_id' => $request->teacher_id,
            'subject_id' => $request->subject_id,
            'class_id'   => $request->class_id,
            'section_id' => $request->section_id,
        ]);

        return redirect()->route('subjectAssignments.edit', $id)
            ->with('success', 'Subject Assignment Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subjectAssignments = SubjectAssignment::findOrFail($id);
        $subjectAssignments->delete();

        return redirect()->route('subjectAssignments.index')->with('success', 'Subject Assignment Deleted Successfully');
    }
}
