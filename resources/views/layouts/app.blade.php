<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menul Bakery</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="container">

    <div class="sidebar">
        <h2>🍞 Menul</h2>
        <a href="/dashboard">🏠 Dashboard</a>
        <a href="/bahan">📦 Data Bahan</a>
        <a href="/bahan-masuk">📥 Bahan Masuk</a>
        <a href="/bahan-keluar">📤 Bahan Keluar</a>
        <a href="/laporan">📊 Laporan</a>
    </div>

    <div class="content">
        <div class="header">
            <h3>Menul Bakery System</h3>
        </div>

        @yield('content')
    </div>

</div>

</body>
</html>