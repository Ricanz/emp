<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAttachment extends Model
{
    // use HasFactory;
    protected $table = 'student_task_attachments';
    protected $fillable = [
        'task_id',
        'file',
        'created_at',
        'updated_at',
    ];

    protected $dates = ['created_at', 'updated_at'];
}
