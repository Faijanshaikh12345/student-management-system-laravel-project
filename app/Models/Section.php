<?php

namespace App\Models;

use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'sections';

    protected  $guarded = [];

    public function class()
    {
        return $this->belongsTo(ClassModel::class , 'class_id');
    }
}
