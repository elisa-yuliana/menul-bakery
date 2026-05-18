<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <title>Login - Menul Bakery</title>
    <style>
        body { background-color: #f8f9fa; }
        .login-container { margin-top: 100px; }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card border-0 shadow p-4" style="width: 100%; max-width: 400px; border-radius: 8px;">
        <div class="card-body">
            <!-- Ikon Person di atas Title (Akses Rahasia Admin) -->
            <div class="text-center mb-3">
                <a href="{{ route('admin.login') }}" id="adminSecretLogo" style="text-decoration: none; cursor: default;">
                    <img src="{{ asset('img/icons/person-circle.svg') }}" width="50" alt="User Icon" class="mb-2">
                </a>
                <h4 class="fw-bold">LOGIN USER</h4>
            </div>
           @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            <ul class="mb-0">
                <li>{{ session('success') }}</li>
            </ul>
        </div>
    @endif
            <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="********" required>
                        <span class="input-group-text" id="togglePassword" style="cursor: pointer; background-color: #fff;">
                            <img src="{{ asset('img/icons/eye.svg') }}" id="eyeIcon" width="20">
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-bold mb-3" style="background-color: #0d6efd;">Login</button>

                <div class="text-center">
                    <p class="small text-muted">Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none">Daftar Staff</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Script jQuery & Password Toggle -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/password-toggle.js') }}"></script>
</body>
</html>