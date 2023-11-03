<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PicApproval extends Model
{
    // use HasFactory;
    protected $table = 'pic_approvals';
    protected $fillable = [
        'student_report_id', 'mentor_id', 'notes', 'type'
    ];

    protected $dates = ['created_at', 'updated_at'];
}
