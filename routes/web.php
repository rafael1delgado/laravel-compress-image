<?php

use App\Http\Controllers\HomeController;
use App\Jobs\CompressImage;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::post('/compress-image', [HomeController::class, 'compressImage'])->name('compress.image');
