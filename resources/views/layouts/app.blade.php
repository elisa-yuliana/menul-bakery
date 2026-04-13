<!DOCTYPE html>
<html>
<head>
    <title>Menul Bakery</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 220px;
            height: 100vh;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
        }

        .sidebar h2 {
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            margin: 10px 0;
            padding: 8px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        /* CONTENT */
        .content {
            flex: 1;
            padding: 20px;
            background-color: #ecf0f1;
            min-height: 100vh;
        }

        .header {
            background-color: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>🍞 Menul</h2>

        <a href="/dashboard">🏠 Dashboard</a>
        <a href="/bahan">📦 Data Bahan</a>
        <a href="/bahan-masuk">📥 Bahan Masuk</a>
        <a href="/bahan-keluar">📤 Bahan Keluar</a>
        <a href="/laporan">📊 Laporan</a>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="header">
            <h3>Menul Bakery System</h3>
        </div>

        @yield('content')

    </div>

</div>

</body>
</html>