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
    $response = Http::get("https://www.googleapis.com/youtube/v3/videos", [
        'part' => 'snippet,statistics',
        'chart' => 'mostPopular',
        'maxResults' => 20,
        'regionCode' => 'US', // Замените на нужный вам код региона
        'key' => $this->apiKey,
    ]);

    // Проверка на ошибки в ответе
    if ($response->failed()) {
        Log::error('YouTube API error: ' . $response->body());
        return []; // Возвращаем пустой массив, если произошла ошибка
    }

    $videos = $response->json()['items'];

    // Фильтрация видео по дате (последние 2 недели)
    $twoWeeksAgo = now()->subWeeks(2);
    $filteredVideos = array_filter($videos, function ($video) use ($twoWeeksAgo) {
        $publishedAt = \Carbon\Carbon::parse($video['snippet']['publishedAt']);
        return $publishedAt->greaterThanOrEqualTo($twoWeeksAgo);
    });

    return $filteredVideos; // Возвращаем отфильтрованный массив видео
}
    
}