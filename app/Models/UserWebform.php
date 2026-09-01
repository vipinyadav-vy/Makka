<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWebform extends Model
{
    use HasFactory;
    public $table = 'user_webforms';
    protected $fillable = [
        'user_id',
        'project_id',
        'webform_id',
        'created_at',
        'updated_at'
    ];
}
