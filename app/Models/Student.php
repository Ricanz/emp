<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = [
        'id',
        'nim',
        'name',
        'image',
        'email',
        'user_id',
        'major_id',
        'mitra_id',
        'dpa',
        'dpl',
        'start_date',
        'end_date',
        'year',
        'phone',
        'gender',
        'is_alumni',
        'history',
        'status',
        'created_at',
        'updated_at'
    ];
    protected $dates = ['start_date', 'end_date', 'created_at', 'updated_at'];

    public function major(){
        return $this->hasOne(Major::class, 'id', 'major_id');
    }

    public function mitra(){
        return $this->hasOne(Mitra::class, 'id', 'mitra_id');
    }

    public function dosen_pa(){
        return $this->hasOne(Mentor::class, 'id', 'dpa')->where('jenis', 'dpa')->where('role', 'lecturer');
    }

    public function dosen_pl(){
        return $this->hasOne(Mentor::class, 'id', 'dpl')->where('jenis', 'dpl')->where('role', 'lecturer');
    }

    public function reports(){
        return $this->hasMany(StudentReport::class, 'id', 'student_id');
    }
}
