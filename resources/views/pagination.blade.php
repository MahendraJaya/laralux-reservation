<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pagination</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }
        .pagination .page-link {
            padding: 0.5rem 0.75rem;
            font-size: 1rem;
            color: black;
        }
    </style>
</head>

<body>
    <h1>Pagination</h1>
    <div class="container mt-5 mb-5">
        @foreach ($hotels as $hotel)
            <div class="card mb-3">
                <div class="card-header">
                    {{ $hotel->name }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">Rating : {{ $hotel->rating }}/5</h5>
                    <p class="card-text">{{ $hotel->address }}</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        @endforeach
        <nav aria-label="Page navigation example">
            <ul class="pagination">
              {{ $hotels->links('pagination::bootstrap-4') }}
            </ul>
        </nav>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>

