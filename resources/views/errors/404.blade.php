<!DOCTYPE html>
<html>
<head>
    <title>404 - Page Not Found</title>
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition">

<div class="container mt-5">
    <div class="card text-center shadow">
        <div class="card-body py-5">
            <h2 class="text-danger">404 — Page Not Found</h2>

            <p class="mt-3">
                The page you are looking for does not exist.
            </p>

            <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">
                Go to Dashboard
            </a>
        </div>
    </div>
</div>

</body>
</html>