<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

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
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(ProductTranslation::class);
    }

    public function category(): HasOne
    {
        return $this->hasOne(Category::class,'id','category');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Tag', 'products_tags');
    }

    public function getProductCategoryAttribute(): string
    {
        return $this->category()->first()->name;
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
