<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierContractorEvalution extends Model
{
    use HasFactory;
    public $table = 'supplier_contractor_evalution';
    protected $fillable = [
        'created_at',
        'updated_at'
    ];
}
