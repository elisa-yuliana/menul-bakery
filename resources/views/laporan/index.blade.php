<!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Menul Bakery</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block navbar sidebar min-vh-100 p-3">
                <h4 class="text-white">Menul Bakery</h4>
                <hr class="text-white">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white {{ request()->is('/') ? : '' }}" href="{{ route('dashboard.index') }}">
                            <img src="{{ asset('img\icons\house-fill.svg') }}" class="me-2 icon-putih"> Dashboard
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white {{ request()->is('bahan') ? 'bg-secondary active' : '' }}" href="{{ route('bahan.index') }}">
                            <img src="{{ asset('img\icons\cart-fill.svg') }}" class="me-2 icon-putih"> Bahan
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white {{ request()->is('bahanMasuk') ? 'bg-secondary active' : '' }}" href="{{ route('bahan_masuk.index') }}">
                            <img src="{{ asset('img\icons\cart-plus-fill.svg') }}" class="me-2 icon-putih"> Bahan Masuk
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white {{ request()->is('bahanKeluar') ? 'bg-secondary active' : '' }}" href="{{ route('bahan_keluar.index') }}">
                            <img src="{{ asset('img\icons\cart-dash-fill.svg') }}" class="me-2 icon-putih"> Bahan Keluar
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white {{ request()->is('laporan') ? 'bg-secondary active' : '' }}" href="{{ route('laporan.index') }}">
                            <img src="{{ asset('img\icons\file-earmark-bar-graph-fill.svg') }}" class="me-2 icon-putih"> Laporan
                        </a>
                    </li>
                </ul>
            </nav>
    <main class="col-md-10 ms-sm-auto px-md-4 py-4">
    <div class="container mt-4">

@section('content')

<h2>📊 Laporan Stok Bahan</h2>

<!-- FILTER TANGGAL -->
<form method="GET" action="{{ url('/laporan') }}">
    Dari:
    <input type="date" name="start_date" value="{{ $start ?? '' }}">

    Sampai:
    <input type="date" name="end_date" value="{{ $end ?? '' }}">

    <button type="submit">Filter</button>

    <a href="/laporan">Reset</a>
</form>

<br>

<!-- EXPORT PDF (INI YANG TADI ERROR) -->
<a href="{{ url('/laporan/pdf?start_date='.$start.'&end_date='.$end) }}" 
   target="_blank" 
   class="btn-export">
   📄 Export PDF
</a>

<br><br>

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

            <td>
                Rp {{ number_format($item['harga'], 0, ',', '.') }}
            </td>

            <td>{{ $item['metode'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<br>

<a href="/dashboard" class="back-btn">⬅️ Kembali ke Dashboard</a>
