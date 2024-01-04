<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageSorted extends Model
{
    use HasFactory;

    protected $table = 'language_sorted';

    protected $fillable = ['lang_id', 'name', 'code', 'enabled'];
}
