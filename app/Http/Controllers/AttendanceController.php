<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\ClassModel;

class AttendanceController extends Controller
{
    public function selectForm()
    {
        $classes = ClassModel::all();
        $sections = Section::all();
        return view('attendance.select', compact('classes', 'sections'));
    }

    public function showStudents(Request $request)
    {
        $students = Student::where('class_id', $request->class_id)
            ->where('section_id', $request->section_id)
            ->get();

        return view('attendance.mark', [
            'students' => $students,
            'date' => $request->date,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
        ]);
    }

    public function saveAttendance(Request $request)
    {
        foreach ($request->status as $student_id => $status) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $student_id,
                    'date' => $request->date,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        return redirect()->route('attendance.select')->with('success', 'Attendance Saved');
    }
}
