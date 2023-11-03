<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
    // use HasFactory;
    protected $table = 'pics';
    protected $fillable = [
        'user_id',
        'mitra_id',
        'student_id',
        'name',
        'phone',
        'gender',
        'status',
        'image',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function mitra(){
        return $this->hasOne(Mitra::class, 'id', 'mitra_id');
    }

    public function student(){
        return $this->hasOne(Student::class, 'id', 'student_id');
    }

    public function students(){
        return $this->hasMany(Student::class, 'id', 'student_id');
    }
}
