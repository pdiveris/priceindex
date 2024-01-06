<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Language extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['code', 'name', 'enabled'];

    public function productTranslations(): HasMany
    {
        return $this->hasMany(ProductTranslation::class);
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->id,
            'name' => $this->name,
            'code' => $this->code,
        ];
    }
}
