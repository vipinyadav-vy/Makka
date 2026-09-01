<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    public $table = 'projects';
    protected $fillable = [
        'name',
        'location',
        'web_forms',
        'created_at',
        'updated_at'
    ];

    
    
}

