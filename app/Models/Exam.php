<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';
    protected $guarded = [];

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }


    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}
