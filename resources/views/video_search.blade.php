<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Результаты поиска</title>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Результаты поиска для "{{ $query }}"</h2>
        <div class="row">
            @if(count($videos) > 0)
                @foreach($videos as $video)
                    <div class="col-md-4 mb-4">
                        <div class="video">
                            <iframe width="100%" height="255" src="https://www.youtube.com/embed/{{ $video['id'] }}" frameborder="0" allowfullscreen></iframe>
                            <h5 class="pt-2" style="color: black; font-weight: bold;">{{ $video['snippet']['title'] }}</h5>
                            <form method="POST" action="{{ route('watch_later.add', $video['id']) }}">
                                @csrf
                                <input type="hidden" name="video_title" value="{{ $video['snippet']['title'] }}">
                                <button type="submit" class="btn btn-primary btn-sm mt-2">Посмотреть позже</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <h5 class="text-center">Нет результатов для "{{ $query }}"</h5>
                </div>
            @endif
        </div>
    </div>
    @if(session('message'))
        <div class="alert alert-success text-center mt-3">
            {{ session('message') }}
        </div>
    @endif
    <a href="{{ route('watch_later.list') }}" class="btn btn-secondary mt-2">Перейти в "Смотреть позже"</a>
</body>
</html>