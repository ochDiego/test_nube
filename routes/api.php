<?php

use App\Http\Controllers\Api\MangaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/mangas', [MangaController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/mangas', MangaController::class)->except(['index', 'show']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
