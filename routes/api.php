<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('test', function(Request $request) {
    file_put_contents('/tmp/priceindex', print_r($request->toArray(),1));
    return $request->toArray();
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

