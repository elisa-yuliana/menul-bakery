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
        <!-- TOMBOL ATAS -->
        <div class="top-buttons">
            <a href="/bahan/create" class="btn tambah">+ Tambah Bahan</a>
            <a href="/bahan-masuk/create" class="btn masuk">+ Bahan Masuk</a>
            <a href="/bahan-keluar/create" class="btn keluar">+ Bahan Keluar</a>
            <a href="/bahan-keluar" class="btn riwayat">📋 Riwayat Keluar</a>
        </div>

        <!-- TABEL -->
        <table>
            <tr>
                <th>Nama Bahan</th>
                <th>Jenis</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Stok Minimum</th>
                <th>Pembayaran</th>
                <th>Jatuh Tempo</th>
                <th>Aksi</th>
            </tr>

        @foreach($bahans as $bahan)
        <tr>
            <td>{{ $bahan->nama_bahan }}</td>
            <td>{{ $bahan->jenis_bahan }}</td>
            <td>{{ $bahan->kategori }}</td>
            <td>{{ $bahan->jumlah_stok }} {{ $bahan->satuan }} </td>
            <td>Rp {{ number_format($bahan->harga, 0, ',', '.') }}</td>
            <td>{{ $bahan->stok_minimum }}</td>
            <td>{{ $bahan->metode_pembayaran }}</td>
            <td>{{ $bahan->tanggal_jatuh_tempo ?? '-' }}</td>

            <td class="aksi">
                <a href="/bahan/{{ $bahan->id }}/edit">Edit</a>

                <form action="/bahan/{{ $bahan->id }}/delete" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif
        @endforeach

        </table>
    </body>
</html>


                                                        