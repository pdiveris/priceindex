<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;

    protected $appends = [
        'category_translations',
    ];

    protected $fillable = ['id', 'name', 'description', 'media', 'enabled'];

    public function translations(): HasMany
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    public function getCategoryTranslationsAttribute(): array
    {
        $ret = [];
        foreach ($this->translations->all() as $id => $translation) {
            $ret[$translation->lang_id] = [
                'name' => $translation->name,
                'description' => $translation->description,
            ];
        }
        return $ret;
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->id,
            'name' => $this->name,
            'category_translations' => $this->category_translations,
        ];
    }

}
