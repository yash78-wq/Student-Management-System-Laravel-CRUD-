<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='85'>🧑‍🎓</text></svg>">


    <!-- Static navbar & theme styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Favicon -->
</head>

<body>
    <!-- Static Navigation Bar -->
    <nav class="navbar navbar-dark bg-dark px-3">
        <a class="navbar-brand text-white fw-bold" href="/students">Student Management System</a>
        <span class="text-white small">Laravel CRUD Practice</span>
    </nav>

    <!-- Content Section that changes based on pages -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Static Footer -->
    <footer class="text-center mt-5 mb-3 text-muted">
        <small>© 2025 Student Management System </small>
    </footer>
</body>
</html>
