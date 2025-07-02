<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url("{{ asset('ahay.jpg') }}") no-repeat center center fixed;
            background-size: cover;
        }

        .login-wrapper {
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-title {
            font-weight: 600;
            margin-bottom: 20px;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .demo-box {
            background-color: #e9f7ff;
            border-left: 4px solid #0d6efd;
            padding: 10px;
            font-size: 14px;
            margin-top: 20px;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">

    <div class="login-wrapper">
        <h4 class="text-center login-title">🔐 Login ke Sistem</h4>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">📧 Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">🔒 Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Masuk</button>
        </form>

        <div class="demo-box mt-3">
            <strong>Akses Demo:</strong><br>
            Email: <code>aseptaupiqulrahman@gmail.com</code><br>
            Password: <code>12345</code>
        </div>
    </div>

    <script src="{{ asset('assets/jquery-3.6.1.js') }}"></script>
    <script src="{{ asset('assets/bootstrap.min.js') }}"></script>
</body>
</html>
