<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Language;

class DummyController extends Controller
{
    //
    public function something(): string
    {
        // Create an article with translations
        $article = Product::create(['enabled' => true]);

        // $english = Language::where('code', 'en')->first();
        $spanish = Language::where('code', 'es')->first();

        $article->translations()->create([
            'lang_id' => $spanish->id,
            'title' => 'Spanish Title',
            'description' => 'Spanish Description',
        ]);

        // Fetch article in a specific language
        $spanishArticle = $article->translate($spanish->id);

        echo $spanishArticle->title;  // Output: Spanish Title

        return '';
    }
}
