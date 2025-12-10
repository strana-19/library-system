<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📚 Smart Library</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: beige;
            font-family: "Georgia", serif;
        }
        .login-card {
            max-width: 400px;
            margin: 100px auto;
            background: floralwhite;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(139, 94, 52, 0.2);
        }
        .btn-login {
            background-color: saddlebrown;
            color: white;
            font-weight: bold;
        }
        .btn-login:hover {
            background-color: brown;
        }
        h3 {
            color: sienna;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h3 class="text-center mb-4">📚 Smart Library</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first('login') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-login w-100 mt-3">Login</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
