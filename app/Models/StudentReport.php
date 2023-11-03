<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentReport extends Model
{
    protected $table = 'student_reports';
    protected $fillable = [
        'id',
        'student_id',
        'title',
        'reports',
        'type',
        'approved_by_lecturer',
        'approved_by_partner',
        'approved_at',
        'created_at',
        'updated_at',
        'week_id',
        'intern_date'
    ];

    protected $dates = ['approved_at', 'created_at', 'updated_at', 'intern_date'];

    public function attendance(){
        return $this->hasOne(Attendance::class, 'report_id', 'id');
    }

    public function student(){
        return $this->hasOne(Student::class, 'id', 'student_id');
    }

    public function mitra(){
        return $this->hasOne(Mitra::class, 'id', 'student_id');
    }

    public function file(){
        return $this->hasMany(StudentReportAttacment::class,'student_report_id');
    }
    public function attachment(){
        return $this->hasMany(DailyAttachment::class, 'report_id', 'id');
    }

    public function approval(){
        return $this->hasOne(ApprovalReport::class, 'student_report_id', 'id')->where('type', 'daily');
    }

    public function mitra_approval(){
        return $this->hasOne(PicApproval::class, 'student_report_id', 'id')->where('type', 'daily');
    }
}
