<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $anime->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            font-family: monospace;
        }

        .cover-wrap {
            background: #111;
            border-radius: 12px;
            overflow: hidden;
            aspect-ratio: 2 / 3;
        }

        .cover-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container mt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card shadow-sm">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">{{ $anime->title }}</h5>
                        <a href="{{ route('animes.index') }}" class="btn btn-sm btn-secondary">← Back to List</a>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">

                            <div class="col-md-4">
                                @if ($anime->cover_image)
                                    <div class="cover-wrap">
                                        <img src="{{ $anime->cover_image }}" alt="{{ $anime->title }}">
                                    </div>
                                @else
                                    <div class="cover-wrap d-flex align-items-center justify-content-center text-muted">
                                        No Image
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-8 d-flex flex-column">
                                <h4 class="mb-3">{{ $anime->title }}</h4>

                                <table class="table table-bordered">
                                    <tr>
                                        <th width="140">Genre</th>
                                        <td><span class="badge bg-secondary">{{ $anime->genre }}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Episodes</th>
                                        <td>{{ $anime->episodes }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            <span
                                                class="fw-semibold
                                                @if ($anime->status == 'Completed') text-success
                                                @elseif ($anime->status == 'Watching') text-primary
                                                @elseif ($anime->status == 'Dropped') text-danger
                                                @else text-warning @endif">
                                                {{ $anime->status }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Rating</th>
                                        <td>⭐ {{ $anime->rating }}/10</td>
                                    </tr>
                                    <tr>
                                        <th>Studio</th>
                                        <td>{{ $anime->studio }}</td>
                                    </tr>
                                    <tr>
                                        <th>Added</th>
                                        <td>{{ $anime->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated</th>
                                        <td>{{ $anime->updated_at->format('M d, Y') }}</td>
                                    </tr>
                                </table>

                                <div class="mt-auto d-flex justify-content-between">
                                    <a href="{{ route('animes.edit', $anime->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('animes.destroy', $anime->id) }}" method="POST"
                                        onsubmit="return confirm('Remove {{ addslashes($anime->title) }} from your list?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
