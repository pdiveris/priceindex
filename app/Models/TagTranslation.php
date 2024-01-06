<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class TagTranslation extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['lang_id', 'tag_id', 'tag'];

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'tag_id');
    }

    public function toSearchableArray(): array
    {
        return $this->toArray();
    }
}
