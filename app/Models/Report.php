<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'period_id',
        'employee_id',
        'file_name',
        'file_type'
    ];

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
