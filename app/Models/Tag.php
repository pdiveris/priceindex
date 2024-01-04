<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'products_tags');
    }

    public function translations(): HasMany
    {
        return $this->hasMany(TagTranslation::class);
    }
}
