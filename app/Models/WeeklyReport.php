<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyReport extends Model
{
    // use HasFactory;
    protected $table = 'weekly_reports';
    protected $fillable = [
        'id',
        'student_id',
        'mitra_id',
        'month_id',
        'title',
        'reports',
        'type',
        'approved_by_lecturer',
        'approved_by_partner',
        'approved_at',
        'created_at',
        'updated_at',
        'week_date',
        'week'
    ];

    protected $dates = ['approved_at', 'created_at', 'updated_at', 'week_date'];

    public function student(){
        return $this->hasOne(Student::class, 'id', 'student_id');
    }

    public function mitra(){
        return $this->hasOne(Mitra::class, 'id', 'student_id');
    }

    public function user_reports(){
        return $this->hasMany(StudentReport::class, 'week_id', 'id');
    }

    public function lecturer_approval(){
        return $this->hasManyThrough(
            StudentReport::class,
            ApprovalReport::class,
            'student_report_id', // Foreign key on the environments table...
            'student_id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'id' // Local key on the environments table...
        );
    }

    public function attachment(){
        return $this->hasMany(WeeklyAttachment::class, 'week_id', 'id');
    }

    public function approval(){
        return $this->hasOne(ApprovalReport::class, 'student_report_id', 'id')->where('type', 'weekly');
    }

    public function mitra_approval(){
        return $this->hasOne(PicApproval::class, 'student_report_id', 'id')->where('type', 'weekly');
    }
}
