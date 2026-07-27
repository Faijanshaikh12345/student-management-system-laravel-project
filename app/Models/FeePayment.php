<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeePayment extends Model
{
    protected $table = 'fee_payments';
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
