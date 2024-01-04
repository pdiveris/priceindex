<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;

    protected $fillable = [
        'name',
        'description',
        'category',
        'unit',
        'enabled',
    ];

    protected $appends = [
        'product_tags',
        'product_category',
        'product_unit'
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(ProductTranslation::class);
    }

    public function category(): HasOne
    {
        return $this->hasOne(Category::class,'id','category');
    }

    public function unit(): HasOne
    {
        return $this->hasOne(Unit::class,'id','unit');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Tag', 'products_tags');
    }

    public function getProductCategoryAttribute(): string
    {
        return $this->category()->first()->name ?? '';
    }

    public function getProductUnitAttribute(): string
    {
        return $this->unit()->first()->unit ?? '';
    }

    public function getProductTagsAttribute(): Collection
    {
        return $this->tags()->pluck('tag');
    }

    public function translate($langId)
    {
        return $this->translations->where('lang_id', $langId)->first();
    }

    public function toSearchableArray()
    {
        // @TODO: add tags
        // @TODO: add translations

        return [
            'id' => (int) $this->id,
            'name' => $this->name,
/*            'description' => $this->description,
            'category' => $this->product_category,
            'unit' => $this->product_unit,
            'tags' => $this->tags->pluck('tag')->toArray(),
            'translations' => $this->translations->pluck('name')->toArray(),*/
        ];
    }
}
