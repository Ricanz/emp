<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalReport extends Model
{
    // use HasFactory;
    protected $table = 'approval_reports';
    protected $fillable = [
        'student_report_id',
        'mentor_id',
        'title',
        'notes',
        'type',
        'created_at',
        'updated_at'
    ];
}
