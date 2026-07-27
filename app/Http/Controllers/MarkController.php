<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class MarkController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    // Step 1: Select Exam & Subject
    public function index()
    {
        $marks = Mark::with(['student', 'subject', 'exam'])->latest()->get();
        return view('manage_student_marks', compact('marks'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        $exams = Exam::all();
        $subjects = Subject::all();
        return view('create_student_marks', compact('students', 'exams', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'exam_id' => 'required',
            'subject_id' => 'required',
        ]);

        $exam = Exam::findOrFail($request->exam_id);

        $students = Student::where('class_id', $exam->class_id)
            ->where('section_id', $exam->section_id)
            ->get();

        return view('show_students', [
            'students' => $students,
            'exam_id' => $request->exam_id,
            'subject_id' => $request->subject_id
        ]);
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
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    // Step 3: Save marks
    public function update(Request $request, $id)
    {
        foreach ($request->marks as $student_id => $marks_obtained) {

            Mark::updateOrCreate(
                [
                    'exam_id' => $request->exam_id,
                    'student_id' => $student_id,
                    'subject_id' => $request->subject_id,
                ],
                [
                    'marks_obtained' => $marks_obtained,
                    'max_marks' => $request->max_marks,
                ]
            );
        }

        return redirect()->route('marks.index')
            ->with('success', 'Marks saved successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $marks = Mark::findOrFail($id);
        $marks->delete();

        return redirect()->route('marks.index')->with('success', 'Marks deleted successfully');
    }


    public function saveMarks(Request $request)
    {
        foreach ($request->marks as $student_id => $marks_obtained) {

            Mark::updateOrCreate(
                [
                    'exam_id'    => $request->exam_id,
                    'subject_id' => $request->subject_id,
                    'student_id' => $student_id,
                ],
                [
                    'max_marks'      => $request->max_marks[$student_id],
                    'marks_obtained' => $marks_obtained,
                ]
            );
        }

        return redirect()->route('marks.create')
            ->with('success', 'Marks saved successfully');
    }
}
