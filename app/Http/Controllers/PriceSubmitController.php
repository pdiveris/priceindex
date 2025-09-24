<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePriceRequest;
use Illuminate\Http\Request;

class PriceSubmitController extends Controller
{
    public function __invoke(StorePriceRequest $request)
    {
        // $user = User::create($request->validated());

        dump($request);
    }
}
