<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <title>Daftar Staff - Menul Bakery</title>
    <style>
        body { background-color: #f8f9fa; }
        .register-container { margin-top: 50px; margin-bottom: 50px; }
        .card { border-radius: 8px; }
        /* Menghilangkan shadow biru berlebih saat input fokus agar lebih bersih */
        .form-control:focus { box-shadow: none; border-color: #0d6efd; }
    </style>
</head>
<body>
    <div class="container register-container d-flex justify-content-center align-items-center">
        <div class="row justify-content-center w-100">
            <div class="col-md-5">
                <div class="card shadow border-0">
                   <div class="card-body p-4">
    <div class="text-center mb-3">
        <img src="{{ asset('img/icons/person-circle.svg') }}" width="50" alt="User Icon" class="mb-2">
        <h4 class="fw-bold">DAFTAR AKUN</h4>
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
 
    <form action="{{ route('register.submit') }}" method="POST">
        @csrf
        <input type="hidden" name="role" value="admin">
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" placeholder="Masukkan nama" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
                            </div>

                            <!-- Input Password dengan Fitur Mata -->
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="********" required>
                                    <span class="input-group-text" id="togglePassword" style="cursor: pointer; background-color: #fff;">
                                        <img src="{{ asset('img/icons/eye.svg') }}" id="eyeIcon" width="20">
                                    </span>
                                </div>
                            </div>

                            <!-- Input Konfirmasi Password dengan Fitur Mata -->
                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="********" required>
                                    <span class="input-group-text" id="togglePasswordConfirmation" style="cursor: pointer; background-color: #fff;">
                                        <img src="{{ asset('img/icons/eye.svg') }}" id="eyeIconConfirmation" width="20">
                                    </span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 fw-bold mb-2" style="background-color: #0d6efd;">Daftar</button>
                            <a href="{{ route('login') }}" class="btn btn-secondary w-100 fw-bold">Kembali ke Login</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script jQuery & Password Toggle -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/password-toggle.js') }}"></script>
</body>
</html>