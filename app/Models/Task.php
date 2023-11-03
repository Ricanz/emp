<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable = [
        'title',
        'description',
        'image',
        'start_date',
        'end_date',
        'status',
        'created_at',
        'updated_at',
        'student_id',
        'type',
        'mentor_id'
    ];

    protected $dates = ['created_at', 'updated_at', 'start_date', 'end_date'];

    public function student(){
        return $this->hasOne(Student::class, 'id', 'student_id');
    }

    public function student_task(){
        return $this->hasOne(StudentTask::class, 'task_id', 'id');
    }

    public function approval(){
        return $this->hasOneThrough(
            ApprovalTask::class,
            StudentTask::class,
            'task_id', 
            'student_task_id', 
            'id', 
            'id' 
        );
    }

    public function attachment(){
        return $this->hasManyThrough(
            TaskAttachment::class,
            StudentTask::class,
            'task_id', 
            'task_id', 
            'id', 
            'id' 
        );
    }
}
