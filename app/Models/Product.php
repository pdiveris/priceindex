<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

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
}
