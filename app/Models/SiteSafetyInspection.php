<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSafetyInspection extends Model
{
    use HasFactory;
    public $table = 'site_safety_inspection';
    protected $fillable = [
        'created_at',
        'updated_at'
    ];
}
