<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::resource('books', BookController::class);
Route::post('/addBook', [BookController::class, 'addBook']);
