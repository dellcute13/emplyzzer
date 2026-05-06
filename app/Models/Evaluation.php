<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [
        'employee_id',
        'criteria_id',
        'period_id',
        'score'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

}
