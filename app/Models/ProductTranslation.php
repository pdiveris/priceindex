<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class ProductTranslation extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['lang_id', 'product_id', 'name', 'description'];

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function toSearchableArray(): array
    {
        return $this->toArray();
    }
}
