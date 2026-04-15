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
                    </ul>
                </nav>
        <main class="col-md-10 ms-sm-auto px-md-4 py-4">
        <div class="container mt-4">
            <h1 class="mb-4">Bahan Keluar</h1> <!-- Judul halaman -->
            <a href="/bahan-keluar/create" class="btn btn-primary mb-3">Tambah Bahan Keluar</a> <!-- Tombol untuk menambah data bahan keluar -->
        </div>

    <table>
        <tr>
            <th>Nama Bahan</th>
            <th>Jumlah Keluar</th>
            <th>Tanggal</th>
        </tr>

    @foreach($data as $item)
    <tr>
        <td>{{ $item->bahan->nama_bahan }}</td>
        <td>{{ $item->jumlah_keluar }}</td>
        <td>{{ $item->tanggal_keluar }}</td>
    </tr>
    @endforeach
</table>
