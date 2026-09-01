<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreMeetingTopics extends Model
{
    use HasFactory;
    public $table = 'pre_meeting_topics';

    protected $fillable = [
        'created_at',
        'updated_at'
    ];  
}
