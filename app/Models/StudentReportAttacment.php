<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentReportAttacment extends Model
{
    protected $table = 'student_report_attachments';
    protected $fillable = [
        'student_report_id','file','status','created_at','created_by'
    ];

    // protected $dateFormat = 'm/d/Y';
}
