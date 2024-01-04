<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;


class Tag extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'id', 'tag',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'products_tags');
    }

    public function translations(): HasMany
    {
        return $this->hasMany(TagTranslation::class);
    }

    public function toSearchableArray(): array
    {
        // All model attributes are made searchable
        $array = $this->toArray();

        return $array;
    }
}
