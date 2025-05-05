<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }
        .login-box {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h3 class="text-center mb-4">Login Disini</h3>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="mb-3">
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                @error('email')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                @error('password')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-3 form-check d-flex justify-content-between">
                <div>
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>
                <a href="" class="text-decoration-none">Forgot Password?</a>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
