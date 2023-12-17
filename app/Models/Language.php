<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'enabled'];

    public function productTranslations(): HasMany
    {
        return $this->hasMany(ProductTranslation::class);
    }
}
