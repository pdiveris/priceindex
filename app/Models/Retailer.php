<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Retailer extends Model
{
    protected $fillable = [
        'name',
        'country',
        'class',
        'logo',
        'enabled',
        'enabled',
    ];

    use HasFactory;
    use SoftDeletes;
}
