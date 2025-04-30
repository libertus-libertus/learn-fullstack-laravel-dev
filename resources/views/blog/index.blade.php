<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Belajar Fundamental Laravel</title>
    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body> 
    <div class="container">
        <div class="table-responsive my-3">
            <h1 class="text-center mb-5">Blog Lists</h1>

            <!-- Fitur Pencarian -->
            <form action="" method="get">
                <div class="input-group mb-3">
                    <input type="text" name="cari" class="form-control" placeholder="Search by title" aria-label="Search title" aria-describedby="button" value="{{ $cari }}">
                    <button class="btn btn-secondary" type="submit" id="button">Search</button>
                </div>
            </form>
            
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Judul</th>
                        <th>Slug</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($blogs as $item)
                    <tr>
                        <td>
                            {{ $loop->iteration + (($blogs->currentPage() - 1) * $blogs->perPage()) }}
                        </td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>{{ $item->description }}</td> 
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Sorry! Data with <strong>"{{ $cari }}" </strong> title is Not Found</td>
                    </tr>
                    @endforelse 
                </tbody>
            </table>

            {{ $blogs->links() }}
        </div>
    </div> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>