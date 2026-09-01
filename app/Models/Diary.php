<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory;
    public $table = 'diaries';
    protected $fillable = [
        'created_at',
        'updated_at'
    ];

    
    
}

