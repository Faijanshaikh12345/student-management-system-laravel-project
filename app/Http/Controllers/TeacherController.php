<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('manage_teachers', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create_teacher');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'teacher_name' => 'required',
            'email' => 'required|email|unique:teachers,email',
            'phone' => 'required|digits:10|numeric|unique:teachers,phone',
        ], [
            'name.required' => 'Teacher name is required',
            'email.required' => 'Teacher email is required',
            'phone.required' => 'Teacher phone is required',
            'email.unique' => 'Teacher email already exists',
            'phone.unique' => 'Teacher phone Number already exists',
            'phone.digits' => 'Teacher phone Number must be 10 digits',
        ]);

        $teachers = Teacher::create([
            'name' => $request->teacher_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('teachers.create')->with('success', 'Teacher created successfully');
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
        $teacher = Teacher::findOrFail($id);
        return view('edit_teacher', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'teacher_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:10|numeric',
        ], [
            'name.required' => 'Teacher name is required',
            'email.required' => 'Teacher email is required',
            'phone.required' => 'Teacher phone is required',
            'phone.digits' => 'Teacher phone Number must be 10 digits',
        ]);

        $teachers = Teacher::find($id);
        $teachers->update([
            'name' => $request->teacher_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('teachers.edit' , $id)->with('success', 'Teacher updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teachers = Teacher::find($id);
        $teachers->delete();

        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully');
    }
}
