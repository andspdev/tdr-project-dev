<?php

use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InsertRatingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('top-authors', [AuthorsController::class, 'index'])->name('top_authors');
Route::resource('insert-rating', InsertRatingsController::class)->only(['index', 'store'])->names([
    'index' => 'insert_rating.index',
    'store' => 'insert_rating.store',
]);
