<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Результаты поиска</title>
</head>
<body style="background-color: black; color: white;">
    <div class="container">
        <h2 class="text-center">Результаты поиска для "{{ $query }}"</h2>
        <div class="row">
            @if(count($videos) > 0)
                @foreach($videos as $video)
                    <div class="col-md-4 mb-4">
                        <div class="video">
                            <iframe width="100%" height="255" src="https://www.youtube.com/embed/{{ $video['id'] }}" frameborder="0" allowfullscreen></iframe>
                            <h5 class="pt-2" style="color: #fff; font-weight: bold;">{{ $video['snippet']['title'] }}</h5>
                            <button class="btn btn-primary btn-sm mt-2" 
                                    data-video-id="{{ $video['id'] }}"
                                    data-video-title="{{ $video['snippet']['title'] }}">
                                +
                            </button>
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

    <script>
        $(document).ready(function () {
            $('button').on('click', function () {
                var button = $(this);
                var videoId = button.data('video-id');
                var videoTitle = button.data('video-title');
                
                // Отправляем AJAX-запрос
                $.ajax({
                    url: '{{ route("watch_later.add", ":id") }}'.replace(':id', videoId),
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        video_title: videoTitle,
                    },
                    success: function(response) {
                        // Выводим сообщение об успешном добавлении
                        alert('Видео добавлено в список "Посмотреть позже"!');
                    },
                    error: function(xhr, status, error) {
                        alert('Произошла ошибка при добавлении видео');
                    }
                });
            });
        });
    </script>
</body>
</html>