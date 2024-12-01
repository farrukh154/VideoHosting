<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function create()
    {
        return view('videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'youtube_url' => 'required|url',
        ]);

        $video = new Video();
        $video->title = $request->title;
        $video->description = $request->description;
        $video->youtube_url = $request->youtube_url;
        $video->user_id = auth()->id();
        $video->save();

        return redirect()->route('videos.index')->with('success', 'Video uploaded successfully!');
    }

    public function index()
    {
        $videos = Video::all();
        return view('videos.index', compact('videos'));
    }
}
