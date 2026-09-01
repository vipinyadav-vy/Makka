<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierContractorCar extends Model
{
    use HasFactory;
    public $table = 'supplier_contractor_car';
    protected $fillable = [
        'created_at',
        'updated_at'
    ];
}
