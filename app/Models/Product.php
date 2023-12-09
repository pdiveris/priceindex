<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'unit',
        'enabled',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(ProductTranslation::class);
    }

    public function translate($langId)
    {
        return $this->translations->where('lang_id', $langId)->first();
    }

}
