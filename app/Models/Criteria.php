<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $fillable = [
        'code',
        'name',
        'weight',
        'attribute',
        'description'
    ];

    public function evalutions()
    {
        return $this->hasMany(Evaluation::class);
    }
}
