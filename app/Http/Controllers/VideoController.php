<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client; // Убедитесь, что вы установили Google API Client
use Google\Service\YouTube;

class VideoController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Настройка клиента YouTube API
        $client = new Client();
        $client->setDeveloperKey('AIzaSyBw27L2U0g1Il8ea_6NRxynDhu2dgWQGRU'); // Замените на ваш API ключ

        $youtube = new YouTube($client);

        // Выполнение запроса к YouTube API
        $searchResponse = $youtube->search->listSearch('id,snippet', [
            'q' => $query,
            'maxResults' => 10,
            'type' => 'video',
        ]);

        $videos = [];
        foreach ($searchResponse['items'] as $item) {
            $videos[] = [
                'id' => $item['id']['videoId'],
                'snippet' => $item['snippet'],
            ];
        }

        return view('video_search', compact('videos', 'query'));
    }
}