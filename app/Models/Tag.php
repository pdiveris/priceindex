<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;


class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;

    protected $appends = [
        'tag_translations',
    ];

    protected $fillable = [
        'id', 'tag', 'deleted_at',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'products_tags');
    }

    public function translations(): HasMany
    {
        return $this->hasMany(TagTranslation::class);
    }

    public function getTagTranslationsAttribute(): array
    {
        $ret = [];
        foreach ($this->translations->all() as $id => $translation) {
            $ret[$translation->lang_id] = [
                'tag' => $translation->tag,
            ];
        }
        return $ret;
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->id,
            'tag' => $this->name,
            'tag_translations' => $this->tag_translations,
        ];
    }
}
