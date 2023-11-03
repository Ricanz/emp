<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    protected $table = 'mitras';
    protected $fillable = [
        'id',
        'name',
        'description',
        'address',
        'image',
        'status',
        'phone',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function mentor(){
        return $this->hasOne(Mentor::class, 'mitra_id', 'id');
    }
}
