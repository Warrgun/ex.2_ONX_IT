<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\ReviewesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/book_data', [BooksController::class, 'store']);
Route::get('/books', [BooksController::class, 'index']);
Route::get('/reviews', [ReviewesController::class, 'index']);
