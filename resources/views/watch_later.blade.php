<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

<div class="container">
    <h1 class="text-center">Список "Посмотреть позже"</h1>
    <div class="row">
        @foreach ($videos as $entry)
            <div class="col-md-4 mb-4">
                <div class="video">
                    <iframe width="100%" height="255" src="https://www.youtube.com/embed/{{ $entry->video_id }}" frameborder="0" allowfullscreen></iframe>
                    <h5 class="pt-2" style="color: black; font-weight: bold;">{{ $entry->video_title }}</h5>
                    <form method="POST" action="{{ route('watch_later.remove', $entry->video_id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm mt-2">Удалить</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

</body>
</html>

