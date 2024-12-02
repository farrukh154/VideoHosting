<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WatchLater;

class WatchLaterController extends Controller
{
    public function add(Request $request, $videoId)
    {
        $user = auth()->user();

        // Проверяем, добавлено ли уже это видео в список пользователя
        $exists = WatchLater::where('user_id', $user->id)
                            ->where('video_id', $videoId)
                            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Это видео уже добавлено в "Посмотреть позже"'], 400);
        }

        // Добавляем видео в список "Посмотреть позже"
        WatchLater::create([
            'user_id' => $user->id,
            'video_id' => $videoId,
            'video_title' => $request->video_title,
        ]);

        return response()->json(['message' => 'Видео добавлено в "Посмотреть позже"'], 200);
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