<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', \App\Http\Controllers\MainController::class);

Route::resource('articles', \App\Http\Controllers\Articles\ArticlesController::class)->only(['index', 'show']);

Route::middleware('auth:web')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/avatar-store', [ProfileController::class, 'avatarStore'])->name('profile.avatar.store');
    Route::post('/profile/avatar-delete', [ProfileController::class, 'avatarDelete'])->name('profile.avatar.delete');
});

require __DIR__.'/auth.php';
