<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionTrade extends Model
{
    use HasFactory;
    public $table = 'inspection_trade_details';

    protected $fillable = [
        'created_at',
        'updated_at'
    ];  
}
