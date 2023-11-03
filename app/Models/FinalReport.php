<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalReport extends Model
{
    // use HasFactory;
    protected $table = 'final_reports';
    protected $fillable = [
        'student_id',
        'title',
        'reports',
        'file',
        'approved_by_lecturer',
        'approved_by_partner',
        'approved_at',
        'created_at',
        'updated_at'
    ];
    protected $dates = [
        'approved_at',
        'created_at',
        'updated_at'
    ];

    public function attachment(){
        return $this->hasOne(FinalReportAttachment::class, 'report_id', 'id');
    }

    public function approval(){
        return $this->hasOne(ApprovalReport::class, 'student_report_id', 'id')->where('type', 'final');
    }

    public function mitra_approval(){
        return $this->hasOne(PicApproval::class, 'student_report_id', 'id')->where('type', 'final');
    }
}
