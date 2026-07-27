<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ClassModelController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectAssignmentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AdminAuthController::class, 'login'])->name('login.post');
Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

Route::middleware(['admin.auth'])->group(function () {
    // Route::get('dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');

    Route::Resource('class', ClassModelController::class);
    Route::Resource('sections', SectionController::class);
    Route::Resource('subjects', SubjectController::class);
    Route::Resource('teachers', TeacherController::class);
    Route::Resource('students', StudentController::class);
    Route::Resource('subjectAssignments', SubjectAssignmentController::class);

    //  attendance
    Route::get('/attendance', [AttendanceController::class, 'selectForm'])->name('attendance.select');
    Route::post('/attendance/show', [AttendanceController::class, 'showStudents'])->name('attendance.show');
    Route::post('/attendance/save', [AttendanceController::class, 'saveAttendance'])->name('attendance.save');

    Route::resource('fees', FeeController::class);

    Route::Resource('exams', ExamController::class);
    Route::resource('marks', MarkController::class);
    Route::post('marks/save', [MarkController::class, 'saveMarks'])->name('marks.save');
});

Route::get('/get-sections/{class_id}', [StudentController::class, 'getSections']);
