<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <title>Daftar Admin - Menul Bakery</title>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            margin-top: 100px;
        }
    </style>
</head>

<body>
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow border-0">
                    <div class="card-body p-4">
                        <h4 class="text-center mb-4">MENUL BAKERY</h4>
                        @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('admin.register.submit') }}" method="POST">
    @csrf
    <h3 class="text-center">Daftar Akun Admin </h3>
    
    <input type="hidden" name="role" value="admin">

    <div class="mb-3">
        <label>Nama </label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email </label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
    <label class="form-label">Password</label>
    <div class="input-group">
        <!-- Input Password -->
        <input type="password" name="password" id="password" class="form-control" required>
        
        <!-- Wadah Ikon Mata menggunakan tag <img> -->
        <span class="input-group-text" id="togglePassword" style="cursor: pointer; background-color: #fff;">
            <img src="{{ asset('img/icons/eye.svg') }}" id="eyeIcon" width="20" alt="Lihat Password">
        </span>
    </div>
</div>
    <div class="mb-3">
        <label>Konfirmasi Password</label>
        <div class="input-group">
            <!-- Input Konfirmasi Password -->
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            
            <!-- Wadah Ikon Mata untuk Konfirmasi Password -->
            <span class="input-group-text" id="togglePasswordConfirmation" style="cursor: pointer; background-color: #fff;">
                <img src="{{ asset('img/icons/eye.svg') }}" id="eyeIconConfirmation" width="20" alt="Lihat Konfirmasi Password">
            </span>
        </div>
    </div>
    <a href="{{ route('admin.login') }}" class="btn btn-secondary w-100 mb-2">Kembali ke Login</a>
    <button type="submit" class="btn btn-danger w-100">Daftar</button>
</form>
   </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Pastikan pemanggilan JS di bawah sebelum </body> -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/password-toggle.js') }}"></script>
</body>
</html>