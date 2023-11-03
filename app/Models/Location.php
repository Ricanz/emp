<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'location';
    protected $fillable = [
        'location',
        'status'
    ];

    //protected $dates = ['created_at', 'updated_at', 'end_date'];

}
