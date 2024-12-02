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
</body>
</html>