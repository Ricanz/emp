<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    // use HasFactory;
    protected $table = 'answers';
    protected $fillable = [
        'question_id',
        'answer',
        'reply_by',
        'status'
    ];

    protected $dates = ['created_at', 'updated_at'];
}
