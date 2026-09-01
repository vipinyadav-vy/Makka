<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierContractorCarProblem extends Model
{
    use HasFactory;
    public $table = 'supplier_contractor_car_problems';
    protected $fillable = [
        'created_at',
        'updated_at'
    ];
}
