<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Tambah Blog</title>
    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body> 
    <div class="container">
        <div class="table-responsive my-3">
            <h1 class="mb-3">Tambah Berita Baru</h1>

            <form action="{{ route('blog.store') }}" method="POST">
                @csrf 

                <div class="form-group mb-3">
                    <label for="title">Judul Berita</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" autofocus>
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="description">Konten Berita</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    @foreach ($tags as $key => $tag)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="tags[]" id="tag{{ $key }}" value="{{ $tag->id }}">
                            <label for="tag{{ $key }}" class="form-check-label">{{ $tag->name }}</label>
                        </div>
                    @endforeach 
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan Berita</button>
                    <a href="{{ route('blog.index') }}" class="btn btn-secondary btn-sm">
                        Kembali ke halaman utama
                    </a>
                </div>
            </form>
        </div>
    </div> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>