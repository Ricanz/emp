<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalTask extends Model
{
    // use HasFactory;
    protected $table = 'approval_tasks';
    protected $fillable = [
        'student_task_id',
        'mentor_id',
        'title',
        'notes',
        'created_at',
        'updated_at'
    ];

    protected $dates = ['created_at', 'updated_at'];
}
