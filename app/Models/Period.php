<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $fillable = [
        'name',
        'created_by',
        'status'
    ];

    public function evalutions()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function rankings()
    {
        return $this->hasMany(Ranking::class);
    }
}
