<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // use HasFactory;
    protected $table = 'questions';
    protected $fillable = [
        'student_id',
        'question',
        'status',
        'created_at',
        'updated_at',
        'code'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function answer(){
        return $this->hasMany(Answer::class, 'question_id')->orderBy('created_at');
    }
}
