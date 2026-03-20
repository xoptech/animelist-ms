<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet">
    <style>
        * {
            font-family: monospace;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 20;
            font-size: 18px;
            vertical-align: middle;
        }

        .title1 {
            font-size: 2.9rem;
        }

        .title2 {
            color: gray;
        }

        .anime-card {
            transition: transform 0.2s, box-shadow 0.2s;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .anime-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .anime-cover-wrap {
            aspect-ratio: 2 / 3;
            background: #111;
            overflow: hidden;
        }

        .anime-cover {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .anime-cover-placeholder {
            aspect-ratio: 2 / 3;
            background-color: #2a2a2a;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 0.85rem;
        }

        .card-title {
            font-size: 0.9rem;
            font-weight: bold;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .action-btn {
            text-decoration: none;
            border: none;
            background: none;
            padding: 4px 6px;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.15s;
            display: inline-flex;
            align-items: center;
        }

        .action-btn:hover {
            background: rgba(0, 0, 0, 0.07);
        }

        .action-btn.view {
            color: #0dcaf0;
        }

        .action-btn.edit {
            color: #ffc107;
        }

        .action-btn.delete {
            color: #dc3545;
        }

        .pagination {
            gap: 4px;
        }

        .page-link {
            border-radius: 8px !important;
            border: 1px solid #dee2e6;
            color: #333;
            padding: 6px 12px;
            font-size: 0.85rem;
        }

        .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
        }

        .page-item.disabled .page-link {
            color: #adb5bd;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container mt-5 pb-5">

        <div class="row mb-4 align-items-center">
            <div class="col d-flex align-items-baseline">
                <h1 class="title1">Anime</h1>
                <sub>
                    <h1 class="title2">List</h1>
                </sub>
            </div>
            <div class="col text-end">
                <a href="{{ route('animes.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-1">
                    <span class="material-symbols-outlined">add</span> Add to my list
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($animes->isEmpty())
            <div class="text-center py-5 text-muted">
                <p class="fs-5">No anime found. Start adding some!</p>
                <a href="{{ route('animes.create') }}" class="btn btn-primary">Add Anime</a>
            </div>
        @else
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3">
                @foreach ($animes as $anime)
                    <div class="col">
                        <div class="card h-100 anime-card">

                            @if ($anime->cover_image)
                                <div class="anime-cover-wrap">
                                    <img src="{{ $anime->cover_image }}" alt="{{ $anime->title }}" class="anime-cover">
                                </div>
                            @else
                                <div class="anime-cover-placeholder">No Image</div>
                            @endif

                            <div class="card-body d-flex flex-column px-2 py-2">
                                <p class="card-title mb-1" title="{{ $anime->title }}">{{ $anime->title }}</p>

                                <div class="d-flex gap-1 flex-wrap mb-1">
                                    <span class="badge bg-secondary"
                                        style="font-size:0.65rem">{{ $anime->genre }}</span>
                                    <span class="badge bg-warning text-dark" style="font-size:0.65rem">⭐
                                        {{ $anime->rating }}/10</span>
                                </div>

                                <small class="text-muted" style="font-size:0.7rem">{{ $anime->studio }}</small>
                                <small style="font-size:0.7rem">
                                    {{ $anime->episodes }} eps &bull;
                                    <span
                                        class="fw-semibold
                                        @if ($anime->status == 'Completed') text-success
                                        @elseif ($anime->status == 'Watching') text-primary
                                        @elseif ($anime->status == 'Dropped') text-danger
                                        @else text-warning @endif">{{ $anime->status }}</span>
                                </small>

                                <div class="mt-auto pt-2 d-flex justify-content-end gap-1">
                                    <a href="{{ route('animes.show', $anime->id) }}" class="action-btn view"
                                        title="View">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </a>
                                    <a href="{{ route('animes.edit', $anime->id) }}" class="action-btn edit"
                                        title="Edit">
                                        <span class="material-symbols-outlined">edit</span>
                                    </a>
                                    <form action="{{ route('animes.destroy', $anime->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Remove {{ addslashes($anime->title) }} from your list?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete" title="Delete">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex flex-column align-items-center mt-4 gap-1">
                <div>{{ $animes->links('pagination::bootstrap-5') }}</div>
                <small class="text-muted">
                    Showing {{ $animes->firstItem() }}–{{ $animes->lastItem() }} of {{ $animes->total() }} anime
                </small>
            </div>
        @endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
