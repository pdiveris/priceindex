<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PriceSubmitController extends Controller
{
    public function __invoke(Request $request)
    {
        dump($request);
    }
}
