<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubrik extends Model
{
    // use HasFactory;
    protected $table = 'rubriks';
    protected $fillable = [
        'student_id',
        'file',
        'status',
        'type',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    protected $dates = ['created_at', 'updated_at'];
}
