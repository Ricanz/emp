<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';
    protected $fillable = [
        'id',
        'student_id',
        'report_id',
        'checkin',
        'checkout',
        'notes',
        'lat',
        'lng',
        'approved_at',
        'created_at',
        'updated_at'
    ];

    protected $dates = [
        'checkin',
        'checkout',
        'approved_at',
        'created_at',
        'updated_at'
    ];
    // protected $dateFormat = 'm/d/Y';
}
