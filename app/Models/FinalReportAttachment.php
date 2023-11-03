<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalReportAttachment extends Model
{
    // use HasFactory;
    protected $table = 'final_report_attachments';
    protected $fillable = [
        'report_id',
        'file',
        'created_at',
        'updated_at'
    ];
}
