<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class PreStartChecklist extends Model
{
    use HasFactory;
    public $table = 'pre_start_checklist';
    protected $fillable = [
        'created_at',
        'updated_at'
    ];
}
