<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    // use HasFactory;
    protected $table = 'careers';
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'slug',
        'location',
        'image',
        'type',
        'status',
        'created_by',
        'updated_by',
        'start_date',
        'end_date',
        'created_at',
        'updated_at'
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at'
    ];

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
