<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    protected $table = 'mentors';
    protected $fillable = [
        'id',
        'user_id',
        'student_id',
        'nidn',
        'name',
        'email',
        'phone',
        'gender',
        'role',
        'jenis',
        'status',
        'image',
        'mitra_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function student(){
        return $this->hasOne(Student::class, 'id', 'student_id');
    }
}
