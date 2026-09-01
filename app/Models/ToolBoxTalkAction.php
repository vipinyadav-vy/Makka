<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolBoxTalkAction extends Model
{
    use HasFactory;
    public $table = 'tool_box_talk_record_actions';
    protected $fillable = [
        'created_at',
        'updated_at'
    ];

}
