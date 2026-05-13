<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Login Admin- Menul Bakery</title>
    <style>
        body { background-color: #f8f9fa; }
        .login-container { margin-top: 100px; }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow border-0">
                    <div class="card-body p-4">
                        <h4 class="text-center mb-4">LOGIN ADMIN </h4>

                        @if(session('loginError'))
                            <div class="alert alert-danger">{{ session('loginError') }}</div>
                        @endif

                        <form action="{{ route('admin.login.submit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="nama@email.com" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="********" required>
                            </div>
                            <a href="{{ route('login') }}" class="btn btn-secondary w-100 mb-2">Kembali</a>
                            <button type="submit" class="btn btn-primary w-100">Login </button>
                        </form>
                        <div class="mt-3 text-center">
                            <small>Belum punya akun? <a href="{{ route('admin.register') }}">Daftar Admin</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</body>
</html>