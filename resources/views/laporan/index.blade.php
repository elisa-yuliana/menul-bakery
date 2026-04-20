<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menul Bakery</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        .report-card {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
        }

        .filter-box {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .filter-box input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .btn-custom {
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: 500;
        }

        .btn-filter {
            background-color: #3498db;
        }

        .btn-reset {
            background-color: #95a5a6;
        }

        .btn-pdf {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #e74c3c;
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-pdf:hover {
            background-color: #c0392b;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.06);
        }

        th {
            background-color: #2c3e50;
            color: white;
            padding: 12px;
            text-align: center;
        }

        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        .jenis-masuk {
            background-color: #2ecc71;
            color: white;
            padding: 4px 8px;
            border-radius: 5px;
        }

        .jenis-keluar {
            background-color: #e74c3c;
            color: white;
            padding: 4px 8px;
            border-radius: 5px;
        }
    </style>
</head>

<body class="bg-light">
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block navbar sidebar min-vh-100 p-3">
            <h4 class="text-white">Menul Bakery</h4>
            <hr class="text-white">
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="{{ route('dashboard.index') }}">
                        <img src="{{ asset('img/icons/house-fill.svg') }}" class="me-2 icon-putih"> Dashboard
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="{{ route('bahan.index') }}">
                        <img src="{{ asset('img/icons/cart-fill.svg') }}" class="me-2 icon-putih"> Bahan
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="{{ route('bahan_masuk.index') }}">
                        <img src="{{ asset('img/icons/cart-plus-fill.svg') }}" class="me-2 icon-putih"> Bahan Masuk
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="{{ route('bahan_keluar.index') }}">
                        <img src="{{ asset('img/icons/cart-dash-fill.svg') }}" class="me-2 icon-putih"> Bahan Keluar
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white bg-secondary active" href="{{ route('laporan.index') }}">
                        <img src="{{ asset('img/icons/file-earmark-bar-graph-fill.svg') }}" class="me-2 icon-putih"> Laporan
                    </a>
                </li>
            </ul>
        </nav>

        <main class="col-md-10 ms-sm-auto px-md-4 py-4">
            <div class="container mt-4">
                <div class="report-card">

                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ asset('img/icons/clipboard2-data-fill.svg') }}" 
                             class="me-2"
                             style="width: 24px; height: 24px;">
                        <h2 class="mb-0">Laporan Stok Bahan</h2>
                    </div>

                    <!-- FILTER -->
                    <form method="GET" action="{{ url('/laporan') }}" class="filter-box">
                        <label>Dari:</label>
                        <input type="date" name="start_date" value="{{ $start ?? '' }}">

                        <label>Sampai:</label>
                        <input type="date" name="end_date" value="{{ $end ?? '' }}">

                        <button type="submit" class="btn-custom btn-filter">Filter</button>

                        <a href="/laporan" class="btn-custom btn-reset">Reset</a>

                        <a href="{{ url('/laporan/pdf?start_date='.$start.'&end_date='.$end) }}" 
                           target="_blank" 
                           class="btn-pdf">
                            <img src="{{ asset('img/icons/file-pdf-fill.svg') }}" 
                                 style="width: 18px; height: 18px;">
                            Export PDF
                        </a>
                    </form>

                    <!-- TABEL -->
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Bahan</th>
                                <th>Jenis</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($laporan as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item['tanggal'] }}</td>
                                <td>{{ $item['nama_bahan'] }}</td>
                                <td>
                                    @if($item['jenis'] == 'Masuk')
                                        <span class="jenis-masuk">Masuk</span>
                                    @else
                                        <span class="jenis-keluar">Keluar</span>
                                    @endif
                                </td>
                                <td>{{ $item['jumlah'] }}</td>
                                <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                <td>{{ $item['metode'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>