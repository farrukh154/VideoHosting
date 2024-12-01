@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Upload Video</h1>
    <form action="{{ route('videos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="youtube_url">YouTube URL</label>
            <input type="url" class="form-control" id="youtube_url" name="youtube_url" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection