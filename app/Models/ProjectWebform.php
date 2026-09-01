<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectWebform extends Model
{
    use HasFactory;
    public $table = 'project_webforms';
    protected $fillable = [
        'project_id',
        'webform_id',
        'created_at',
        'updated_at'
    ];
}
