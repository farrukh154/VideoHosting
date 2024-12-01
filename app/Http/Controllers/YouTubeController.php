<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class YouTubeController extends Controller
{
    private $apiKey;

    public function __construct() // Исправлено название конструктора
    {
        $this->apiKey = env('YOUTUBE_API_KEY'); // Получаем ключ API из .env файла
    }

    public function getVideos()
{
    $response = Http::get("https://www.googleapis.com/youtube/v3/search", [
        'part' => 'snippet',
        'maxResults' => 10,
        'q' => 'Mr Beast, Ronaldo, cake, RealMadrid', // Замените на свой запрос
        'key' => $this->apiKey,
        'type' => 'video', // Добавлено для получения только видео
    ]);

    // Проверка на ошибки в ответе
    if ($response->failed()) {
        \Log::error('YouTube API error: ' . $response->body());
        return []; // Возвращаем пустой массив, если произошла ошибка
    }

    return $response->json()['items']; // Возвращаем массив видео
}
}