<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProject extends Model
{
    use HasFactory;
    public $table = 'user_projects';
    protected $fillable = [
        'user_id',
        'project_id',
        'program_access',
        'dairy_access',
        'webforms_access',
        'created_at',
        'updated_at'
    ];
}
