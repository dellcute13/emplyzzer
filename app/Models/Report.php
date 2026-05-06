<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'periode_id',
        'created_by',
        'file_name',
        'file_type'
    ];
}
