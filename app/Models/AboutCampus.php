<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutCampus extends Model
{
   
    protected $table = 'about_campuses';
    protected $fillable = [
        'title',
        'description',
        'status',
        'image',
        'type',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'slug',
        'uid'
    ];

    protected $dates = ['created_at', 'updated_at'];

}
