<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
    use HasFactory;
    public $table = 'programs';
    protected $fillable = [
        'created_at',
        'updated_at'
    ];

public function tasks()
{
    return $this->hasMany(ProgramTask::class, 'program_id');
}

    
    
}

