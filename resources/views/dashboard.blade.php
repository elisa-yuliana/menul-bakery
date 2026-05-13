<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

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

                    <h4 class="text-center mb-4">
                        INVENTORI BAKERY
                    </h4>

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

                        <h3 class="text-center mb-4">
                            Daftar Akun Admin
                        </h3>

                        <input type="hidden" name="role" value="admin">

                        <!-- Nama -->
                        <div class="mb-3">
                            <label>Nama</label>

                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label>Email</label>

                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   required>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label>Password</label>

                            <div style="position: relative;">

                                <input type="password"
                                       name="password"
                                       class="form-control"
                                       id="password"
                                       required>

                                <button type="button"
                                        onclick="togglePassword()"
                                        style="
                                            position: absolute;
                                            right: 10px;
                                            top: 50%;
                                            transform: translateY(-50%);
                                            border: none;
                                            background: transparent;
                                            cursor: pointer;
                                            font-size: 18px;
                                        ">
                                    👁
                                </button>

                            </div>
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-3">
                            <label>Konfirmasi Password</label>

                            <div style="position: relative;">

                                <input type="password"
                                       name="password_confirmation"
                                       class="form-control"
                                       id="confirmPassword"
                                       required>

                                <button type="button"
                                        onclick="toggleConfirmPassword()"
                                        style="
                                            position: absolute;
                                            right: 10px;
                                            top: 50%;
                                            transform: translateY(-50%);
                                            border: none;
                                            background: transparent;
                                            cursor: pointer;
                                            font-size: 18px;
                                        ">
                                    👁
                                </button>

                            </div>
                        </div>

                        <!-- Tombol -->
                        <button type="submit"
                                class="btn btn-danger w-100">
                            Daftar
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
function togglePassword() {
    const password = document.getElementById("password");

    if (password.type === "password") {
        password.type = "text";
    } else {
        password.type = "password";
    }
}

function toggleConfirmPassword() {
    const confirmPassword =
        document.getElementById("confirmPassword");

    if (confirmPassword.type === "password") {
        confirmPassword.type = "text";
    } else {
        confirmPassword.type = "password";
    }
}
</script>

</body>
</html>