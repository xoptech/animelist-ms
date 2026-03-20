<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Anime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            font-family: monospace;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Add New Anime</h5>
                        <a href="{{ route('animes.index') }}" class="btn btn-sm btn-secondary">← Back</a>
                    </div>
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('animes.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="genre" class="form-label">Genre</label>
                                    <select class="form-select @error('genre') is-invalid @enderror" id="genre"
                                        name="genre" required>
                                        <option value="">Select Genre</option>
                                        @foreach (['Action', 'Romance', 'Isekai', 'Fantasy', 'Slice of Life', 'Horror', 'Sports', 'Mecha'] as $g)
                                            <option value="{{ $g }}"
                                                {{ old('genre') == $g ? 'selected' : '' }}>{{ $g }}</option>
                                        @endforeach
                                    </select>
                                    @error('genre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status" required>
                                        <option value="">Select Status</option>
                                        @foreach (['Watching', 'Completed', 'Plan to Watch', 'Dropped'] as $s)
                                            <option value="{{ $s }}"
                                                {{ old('status') == $s ? 'selected' : '' }}>{{ $s }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="episodes" class="form-label">Episodes</label>
                                    <input type="number" class="form-control @error('episodes') is-invalid @enderror"
                                        id="episodes" name="episodes" value="{{ old('episodes') }}" min="1"
                                        required>
                                    @error('episodes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="rating" class="form-label">Rating (1–10)</label>
                                    <input type="number" class="form-control @error('rating') is-invalid @enderror"
                                        id="rating" name="rating" value="{{ old('rating') }}" min="1"
                                        max="10" required>
                                    @error('rating')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="studio" class="form-label">Studio</label>
                                <input type="text" class="form-control @error('studio') is-invalid @enderror"
                                    id="studio" name="studio" value="{{ old('studio') }}" required>
                                @error('studio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="cover_image" class="form-label">Cover Image URL <span
                                        class="text-muted">(optional)</span></label>
                                <input type="url" class="form-control @error('cover_image') is-invalid @enderror"
                                    id="cover_image" name="cover_image" value="{{ old('cover_image') }}"
                                    placeholder="https://...">
                                @error('cover_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('animes.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Add Anime</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
