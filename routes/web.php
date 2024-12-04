<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\YouTubeController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\WatchLaterController;


Route::middleware('auth')->group(function () {
    Route::post('/watch-later/{videoId}', [WatchLaterController::class, 'add'])->name('watch_later.add');
    Route::get('/watch-later', [WatchLaterController::class, 'list'])->name('watch_later.list');
    Route::delete('/watch-later/{videoId}', [WatchLaterController::class, 'remove'])->name('watch_later.remove');
});

Route::get('/', [VideoController::class, 'index']);
Route::get('/search', [VideoController::class, 'search'])->name('video.search');

Route::get('/', function (YouTubeController $youtubeController){
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



require __DIR__.'/auth.php';