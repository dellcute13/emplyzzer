<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $fillable = [
        'code',
        'name',
        'weight',
        'attribute'
    ];

    public function evalutions()
    {
        return $this->hasMany(Evaluation::class);
    }
}
