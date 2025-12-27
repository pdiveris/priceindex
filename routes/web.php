<?php

use App\Http\Controllers\PriceAddController;
use App\Http\Controllers\PriceSubmitController;
use App\Http\Controllers\QrCodeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'home');

Route::get('/add', PriceAddController::class)
    ->middleware(['auth', 'verified'])
    ->name('price.add');

Route::post('/add', PriceSubmitController::class)
    ->middleware(['auth', 'verified'])
    ->name('price.submit');

Route::get('/greeting', function () {
    return 'Hello World';
});

Route::get('/qr', [QrCodeController::class, 'show']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

