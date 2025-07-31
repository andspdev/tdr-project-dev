<?php

use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('top-authors', [AuthorsController::class, 'index'])->name('top_authors');
