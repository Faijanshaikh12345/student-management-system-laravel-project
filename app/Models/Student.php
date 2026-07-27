<?php

namespace App\Models;

use App\Models\ClassModel;
use App\Models\Section;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $guarded = [];

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function fees()
    {
        return $this->hasOne(Fee::class);
    }

    public function payments()
    {
        return $this->hasMany(FeePayment::class);
    }
    public function marks()
{
    return $this->hasMany(Mark::class);
}
}
