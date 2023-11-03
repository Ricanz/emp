<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalForm extends Model
{
    // use HasFactory;
    protected $table = 'final_forms';
    protected $fillable = [
        'file',
        'status',
        'type',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    protected $dates = ['created_at', 'updated_at'];
}
