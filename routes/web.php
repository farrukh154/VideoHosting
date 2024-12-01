<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\YouTubeController;

Route::get('/', function (YouTubeController $youtubeController) {
    $videos = $youtubeController->getVideos(); // Получаем видео с YouTube
    return view('welcome', compact('videos')); // Передаем видео в представление
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\VideoController;

Route::middleware(['auth'])->group(function () {
    Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');
    Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');
    Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
});

require __DIR__.'/auth.php';