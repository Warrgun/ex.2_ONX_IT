<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\ReviewesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])
    ->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });

Route::post('/book_data', [BooksController::class, 'store']);
Route::get('/books', [BooksController::class, 'index']);
Route::get('/books-review', [BooksController::class, 'indexReviews']);
Route::get('/reviews', [ReviewesController::class, 'index']);
Route::post('/review_data', [ReviewesController::class, 'store']);
Route::put('/review_data/{id}', [ReviewesController::class, 'update']);
Route::delete('/review_data/{id}', [ReviewesController::class, 'destroy']);
