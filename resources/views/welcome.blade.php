<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='85'>🧑‍🎓</text></svg>">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Student Management System</title>
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="text-center">
            <h1 class="mb-4 fw-bold">Welcome to Student Management System</h1>

            <a href="{{ route('register.form') }}" class="btn btn-primary btn-lg">
                Register
            </a>
            <a href="{{ route('login.form') }}" class="btn btn-primary btn-lg">
                Login
            </a>

        </div>
    </div>

</body>
</html>
