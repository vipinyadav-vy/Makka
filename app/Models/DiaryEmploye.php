<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaryEmploye extends Model
{
    use HasFactory;
    public $table = 'diary_employes';
    protected $fillable = [
        'created_at',
        'updated_at'
    ];

    
    
}

