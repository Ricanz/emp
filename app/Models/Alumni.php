<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    // use HasFactory;
    protected $table = 'alumni';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'image',
        'status',
        'year_of',
        'year_graduate',
        'gender',
        'user_id',
        'major_id',
        'is_approved',
        'created_at',
        'updated_at',
        'history'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function faculty(){
        return $this->hasOneThrough(
            Major::class,
            Faculty::class,
            'id', 
            'faculty_id', 
            'major_id', 
            'id' 
        );
    }

    public function major(){
        return $this->belongsTo(Major::class);
    }
}
