<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramTask extends Model
{
    use HasFactory;
    public $table = 'program_task';
    protected $fillable = [
        'created_at',
        'updated_at'
    ];
}

