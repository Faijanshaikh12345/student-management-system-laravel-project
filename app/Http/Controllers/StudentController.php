<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
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
        $students = Student::with(['class', 'section'])->get();
        return view('manage_students', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = ClassModel::all();
        $sections = Section::all();

        return view('create_student', compact('classes', 'sections'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_name'   => 'required',
            'class_id'       => 'required',
            'section_id'     => 'required',
            'roll_number'    => 'required|unique:students,roll_number',
            'gender'         => 'required',
            'dob'            => 'required|date|before:today',
            'parent_name'    => 'required',
            'parent_contact' => 'required',
            'address'        => 'required',
            'admission_date' => 'required|date',
        ], [
            'student_name.required'   => 'Name is required',
            'class_id.required'       => 'Please Select Class Name',
            'section_id.required'     => 'Please Select Section Name',
            'roll_number.required'    => 'Roll No is required',
            'roll_number.unique'      => 'Roll No already exists',

            'gender.required'         => 'Please select gender',

            'dob.required'            => 'Date of Birth is required',
            'dob.date'                => 'Please enter a valid date',
            'dob.before'              => 'Date of Birth must be before today',

            'parent_name.required'    => 'Parent Name is required',
            'parent_contact.required' => 'Parent Contact is required',
            'address.required'        => 'Address is required',
            'admission_date.required' => 'Admission Date is required',
            'admission_date.date'     => 'Please enter a valid Admission Date',
        ]);

        $students = Student::create([
            'name' => $request->student_name,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'roll_number' => $request->roll_number,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'parent_name' => $request->parent_name,
            'parent_phone' => $request->parent_contact,
            'address' => $request->address,
            'admission_date' => $request->admission_date,
        ]);

        return redirect()->route('students.create')->with('success', 'Student created successfully');
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
        $student = Student::findOrFail($id);
        $classes = ClassModel::all();

        return view('edit_student', compact('student', 'classes'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'student_name'   => 'required',
            'class_id'       => 'required',
            'section_id'     => 'required',
            'roll_number'    => 'required|unique:students,roll_number',
            'gender'         => 'required',
            'dob'            => 'required|date|before:today',
            'parent_name'    => 'required',
            'parent_contact' => 'required',
            'address'        => 'required',
            'admission_date' => 'required|date',
        ], [
            'student_name.required'   => 'Name is required',
            'class_id.required'       => 'Please Select Class Name',
            'section_id.required'     => 'Please Select Section Name',
            'roll_number.required'    => 'Roll No is required',
            'roll_number.unique'      => 'Roll No already exists',

            'gender.required'         => 'Please select gender',

            'dob.required'            => 'Date of Birth is required',
            'dob.date'                => 'Please enter a valid date',
            'dob.before'              => 'Date of Birth must be before today',

            'parent_name.required'    => 'Parent Name is required',
            'parent_contact.required' => 'Parent Contact is required',
            'address.required'        => 'Address is required',
            'admission_date.required' => 'Admission Date is required',
            'admission_date.date'     => 'Please enter a valid Admission Date',
        ]);

        $student->update([
            'name' => $request->student_name,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'roll_number' => $request->roll_number,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'parent_name' => $request->parent_name,
            'parent_phone' => $request->parent_contact,
            'address' => $request->address,
            'admission_date' => $request->admission_date,
        ]);

        return redirect()->route('students.edit', $id)
            ->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $students  = Student::findOrFail($id);
        $students->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }
}
