<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectAssignment extends Model
{
    protected $table = 'subject_assignments';
    protected $guarded = [];

    // Each assignment belongs to ONE teacher
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    // Each assignment belongs to ONE subject
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    // Each assignment belongs to ONE class
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    // Each assignment belongs to ONE section
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
