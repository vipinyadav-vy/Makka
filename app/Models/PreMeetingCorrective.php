<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreMeetingCorrective extends Model
{
    use HasFactory;
    public $table = 'pre_meeting_corrective';

    protected $fillable = [
        'created_at',
        'updated_at'
    ];  
}
