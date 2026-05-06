<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'nip',
        'name',
        'gender',
        'photo',
        'position_id',
        'department_id',
        'join_date',
        'status'
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function evalutions()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function rangkings()
    {
        return $this->hasMany(Ranking::class);
    }
}
