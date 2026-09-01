<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolBoxTalkRecords extends Model
{
    use HasFactory;
    public $table = 'tool_box_talk_records';

    protected $fillable = [
        'created_at',
        'updated_at'
    ];
    
    

   
}
