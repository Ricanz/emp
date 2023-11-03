<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTask extends Model
{
    // use HasFactory;
    protected $table = 'student_tasks';
    protected $fillable = [
        'student_id',
        'title',
        'task_id',
        'file',
        'approved_by_lecturer',
        'is_edit',
        'created_at',
        'updated_at'
    ];
}
