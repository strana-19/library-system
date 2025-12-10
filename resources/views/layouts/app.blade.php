<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: beige; font-family: Georgia, serif;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg mb-4" style="background-color: saddlebrown;">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand text-white fw-bold" href="#">📚 Smart Library</a>

           <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-light btn-sm fw-bold">
        🚪 Logout
    </button>
</form>


        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
