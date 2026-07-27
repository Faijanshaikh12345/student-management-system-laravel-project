<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Exam;
use App\Models\Section;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function getSections($class_id)
    {
        $sections = Section::where('class_id', $class_id)
            ->select('id', 'name')
            ->get();

        return response()->json($sections);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::with(['class', 'section'])
            ->orderBy('id', 'desc')
            ->get();
        return view('manage_exams', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = ClassModel::all();
        $sections = Section::all();
        return view('create_exam', compact('classes', 'sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'exam_name' => 'required',
            'exam_date' => 'required',
        ], [
            'class_id.required' => 'Please Select Class Name',
            'section_id.required' => 'Please Select Section Name',
            'exam_name.required' => 'Name is required',
            'exam_date.required' => 'Date is required',
        ]);


        $exams = Exam::create([
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'name' => $request->exam_name,
            'exam_date' => $request->exam_date,
        ]);

        return redirect()->route('exams.create')->with('success', 'Exam created successfully');
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
        $exams = Exam::findOrFail($id);
        $classes = ClassModel::all();

        return view('edit_exam', compact('exams', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'exam_name' => 'required',
            'exam_date' => 'required',
        ], [
            'class_id.required' => 'Please Select Class Name',
            'section_id.required' => 'Please Select Section Name',
            'exam_name.required' => 'Name is required',
            'exam_date.required' => 'Date is required',
        ]);

        $exams = Exam::findOrFail($id);
        $exams->update([
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'name' => $request->exam_name,
            'exam_date' => $request->exam_date,
        ]);

        return redirect()->route('exams.edit', $id)->with('success', 'Exam updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $exams  = Exam::findOrFail($id);
        $exams->delete();

        return redirect()->route('exams.index')->with('success', 'Exam deleted successfully');
    }
}
