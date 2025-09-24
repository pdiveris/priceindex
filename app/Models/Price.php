<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'product_name',
        'retailer_id',
        'country_code',
        'unit_id',
        'quantity',
        'price',
        'created_at',
        'updated_at'
    ];
}
