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
        'created_at',
        'updated_at'
    ];

    public function projectWebforms()
    {
        return $this->hasMany(ProjectWebform::class, 'project_id', 'id');
    }

}

