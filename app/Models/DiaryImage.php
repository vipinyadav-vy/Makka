<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaryImage extends Model
{
    use HasFactory;
    public $table = 'diary_images';
    protected $fillable = [
        'created_at',
        'updated_at'
    ];

    
    
}

