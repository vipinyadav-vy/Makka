<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreStartMeeting extends Model
{
    use HasFactory;
    public $table = 'pre_start_meetings';

    protected $fillable = [
        'created_at',
        'updated_at'
    ];  
}
