<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionRepresentative extends Model
{
    use HasFactory;
    public $table = 'inspection_representative';

    protected $fillable = [
        'created_at',
        'updated_at'
    ];  
}
