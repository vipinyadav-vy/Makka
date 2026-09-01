<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteInductionRecord extends Model
{
    use HasFactory;
    public $table = 'site_induction_record';
    protected $fillable = [
        'project',
        'created_at',
        'updated_at'
    ];
}
