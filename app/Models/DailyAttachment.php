<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyAttachment extends Model
{
    // use HasFactory;
    protected $table = 'daily_attachments';
    protected $fillable = [
        'report_id',
        'file',
        'created_at',
        'updated_at'
    ];
}
