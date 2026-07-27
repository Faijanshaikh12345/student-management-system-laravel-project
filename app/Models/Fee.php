<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $table = 'fees';
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
