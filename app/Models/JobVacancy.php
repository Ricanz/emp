<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    // use HasFactory;
    protected $table = 'job_vacancies';
    protected $fillable = [
        'title',
        'company',
        'description',
        'slug',
        'image',
        'location',
        'category_id',
        'end_date',
        'status',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];

    protected $dates = ['created_at', 'updated_at', 'end_date'];

    public function locat(){
        return $this->hasOne(Location::class, 'id', 'location');
    }
    public function cate(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
