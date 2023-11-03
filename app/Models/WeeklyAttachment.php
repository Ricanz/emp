<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyAttachment extends Model
{
    // use HasFactory;
    protected $table = 'weekly_attachments';
    protected $fillable = [
        'week_id',
        'file',
        'created_at',
        'updated_at'
    ];
}
