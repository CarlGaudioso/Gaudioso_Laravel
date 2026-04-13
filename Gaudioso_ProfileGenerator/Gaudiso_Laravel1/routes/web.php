<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
Route::post('/profile/destroy-all', [ProfileController::class, 'destroyAll'])->name('profile.destroyAll');
Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
