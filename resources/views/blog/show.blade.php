<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Detail Blog</title>
    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body> 
    <div class="container">
        <div class="table-responsive my-3">
            <h1 class="text-center mb-5">Detail Blog</h1>

            <div class="card">
                <div class="card-header">
                    <strong>Judul:</strong> {{ $blog->title }}
                </div>
                <div class="card-body">
                    <strong>Deskripsi:</strong> {!! $blog->description !!} <br><br>

                    Daftar Tags: <br>
                    @if ($blog->tags->count() == null)
                        - 
                    @else
                    @foreach ($blog->tags as $tag)
                        <a href="">#{{ $tag->name }}</a>
                    @endforeach
                    @endif
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <span>{{ $blog->created_at }}</span>
                    <span>By Admin</span>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <h5>Comments:</h5>
            <form action="{{ route("comment.store", $blog->id) }}" method="post">
                @csrf
                <textarea class="form-control" name="comment_text" cols="30" rows="5" placeholder="Silahkan tinggal komentar Anda disini" style="resize: none"></textarea>
                <button type="submit" class="btn btn-primary btn-sm mt-2">Submit</button>
            </form>
        </div>

        {{-- show-komentar --}}
        <div class="mt-3">
            <hr>
            @if ($blog->comments->count() === 0)
                <span>Belum ada komentar, tuliskan komentar anda disini</span>
            @else
                @foreach ($blog->comments as $comment)
                    <p>{{ $comment->comment_text }}</p>
                @endforeach
            @endif 
        </div>
    </div> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>