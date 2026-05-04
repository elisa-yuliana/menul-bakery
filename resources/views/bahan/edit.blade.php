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
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Bahan</h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('bahan.update', $bahan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama_bahan" class="form-label">Nama Bahan</label>
                                <input type="text" class="form-control" id="nama_bahan" name="nama_bahan" value="{{ $bahan->nama_bahan }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_bahan" class="form-label">Jenis Bahan</label>
                                <input type="text" class="form-control" id="jenis_bahan" name="jenis_bahan" value="{{ $bahan->jenis_bahan }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-control" id="kategori" name="kategori" required>
                                    <option value="Tepung" {{ $bahan->kategori == 'Tepung' ? 'selected' : '' }}>Tepung</option>
                                    <option value="Filling" {{ $bahan->kategori == 'Filling' ? 'selected' : '' }}>Tepung</option>
                                    <option value="Mentega" {{ $bahan->kategori == 'Mentega' ? 'selected' : '' }}>Mentega</option>
                                    <option value="Pelengkap" {{ $bahan->kategori == 'Pelengkap' ? 'selected' : '' }}>Pelengkap</option>
                                    <option value="Topping" {{ $bahan->kategori == 'Topping' ? 'selected' : '' }}>Topping</option>
                                    <option value="kemasan" {{ $bahan->kategori == 'kemasan' ? 'selected' : '' }}>Kemasan</option>
                                    <option value="Susu" {{ $bahan->kategori == 'Susu' ? 'selected' : '' }}>Susu</option>
                                    <option value="Lainnya" {{ $bahan->kategori == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_stok" class="form-label">Stok</label>
                                <input type="number" class="form-control" id="jumlah_stok" name="jumlah_stok" value="{{ $bahan->jumlah_stok }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="satuan" class="form-label">Satuan</label>
                                <select class="form-control" id="satuan" name="satuan" required>
                                    <option value="kg" {{ $bahan->satuan == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                                    <option value="gram" {{ $bahan->satuan == 'gram' ? 'selected' : '' }}>Gram (g)</option>
                                    <option value="sak" {{ $bahan->satuan == 'sak' ? 'selected' : '' }}>Sak</option>
                                    <option value="kantong" {{ $bahan->satuan == 'kantong' ? 'selected' : '' }}>Kantong</option>
                                    <option value="pouch" {{ $bahan->satuan == 'pouch' ? 'selected' : '' }}>Pouch</option>
                                    <option value="botol" {{ $bahan->satuan == 'botol' ? 'selected' : '' }}>Botol</option>
                                    <option value="sisir" {{ $bahan->satuan == 'sisir' ? 'selected' : '' }}>Sisir</option>
                                    <option value="bungkus" {{ $bahan->satuan == 'bungkus' ? 'selected' : '' }}>Bungkus</option>
                                    <option value="lembar" {{ $bahan->satuan == 'lembar' ? 'selected' : '' }}>Lembar</option>
                                    <option value="liter" {{ $bahan->satuan == 'liter' ? 'selected' : '' }}>Liter</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" class="form-control input-harga" 
                                        id="harga_display" 
                                        data-target="harga" 
                                        value="{{ number_format($bahan->harga, 0, ',', '.') }}">

                                    <input type="hidden" name="harga" id="harga" value="{{ $bahan->harga }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="stok_minimum" class="form-label">Stok Minimum</label>
                                <input type="number" class="form-control" id="stok_minimum" name="stok_minimum" value="{{ $bahan->stok_minimum }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                                <select class="form-control" id="metode_pembayaran" name="metode_pembayaran" onchange="toggleJatuhTempo(this.value)" required>
                                    <option value="cash" {{ $bahan->metode_pembayaran == 'cash' ? 'selected' : '' }}>Cash</option>
                                    <option value="tempo" {{ $bahan->metode_pembayaran == 'tempo' ? 'selected' : '' }}>Tempo</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_jatuh_tempo" class="form-label">Jatuh Tempo</label>
                                <input type="date" class="form-control" id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo" value="{{ $bahan->tanggal_jatuh_tempo ? $bahan->tanggal_jatuh_tempo->format('Y-m-d') : '' }}">
                            </div>
                             <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('bahan.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/format-rupiah.js') }}"></script>
</body>
</html>