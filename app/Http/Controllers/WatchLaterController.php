<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WatchLater;

class WatchLaterController extends Controller
{
    public function add(Request $request, $videoId)
    {
        $userId = auth()->id(); // Получаем ID авторизованного пользователя

        // Проверяем, существует ли запись
        $exists = WatchLater::where('user_id', $userId)->where('video_id', $videoId)->exists();
        if ($exists) {
            return redirect()->back()->with('message', 'Видео уже добавлено в список "Посмотреть позже".');
        }

        // Добавляем запись
        WatchLater::create([
            'user_id' => $userId,
            'video_id' => $videoId,
            'video_title' => $request->input('video_title'),
        ]);

        return redirect()->back()->with('message', 'Видео добавлено в список "Посмотреть позже".');
    }

    public function list()
    {
        $userId = auth()->id();
        $videos = WatchLater::where('user_id', $userId)->get();

        return view('watch_later', compact('videos'));
    }

    public function remove($videoId)
    {
        $userId = auth()->id();

        WatchLater::where('user_id', $userId)->where('video_id', $videoId)->delete();

        return redirect()->back()->with('message', 'Видео удалено из списка "Посмотреть позже".');
    }
}