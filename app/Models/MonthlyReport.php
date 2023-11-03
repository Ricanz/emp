<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyReport extends Model
{
    // use HasFactory;
    protected $table = 'monthly_reports';
    protected $fillable = [
        'student_id',
        'title',
        'reports',
        'type',
        'approved_by_lecturer',
        'approved_by_partner',
        'approved_at',
        'created_at',
        'updated_at',
        'month',
        'month_date'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'approved_at', 'month_date'
    ];

    public function first_week(){
        return $this->hasOne(WeeklyReport::class, 'month_id', 'id');
    }

    public function week_reports(){
        return $this->hasMany(WeeklyReport::class, 'month_id', 'id');
    }

    public function attachment(){
        return $this->hasMany(MonthlyAttachment::class, 'month_id', 'id');
    }

    public function approval(){
        return $this->hasOne(ApprovalReport::class, 'student_report_id', 'id')->where('type', 'monthly');
    }

    public function mitra_approval(){
        return $this->hasOne(PicApproval::class, 'student_report_id', 'id')->where('type', 'monthly');
    }
}
