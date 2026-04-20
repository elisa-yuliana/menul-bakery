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
                        <h5 class="mb-0">Daftar Stok Bahan Roti</h5>
                        <div>
                            <button type="button" class="btn btn-text btn-light btn-sm " data-bs-toggle="modal" data-bs-target="#modalTambah">
                                + Tambah Bahan
                            </button>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success m-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
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
                                </thead>
                                <tbody>
                                    @php $No = 1; @endphp

                                    @forelse($bahans as $bahan)
                                    <tr>
                                        <td>{{ $No++ }}</td>
                                        <td>{{ $bahan->nama_bahan }}</td>
                                        <td>{{ $bahan->jenis_bahan }}</td>
                                        <td>{{ $bahan->kategori }}</td>
                                        <td>{{ $bahan->jumlah_stok }} {{ $bahan->satuan }} </td>
                                        <td>Rp {{ number_format($bahan->harga, 0, ',', '.') }}</td>
                                        <td>{{ $bahan->stok_minimum }}</td>
                                        <td>{{ $bahan->metode_pembayaran }}</td>
                                        <td>{{ $bahan->tanggal_jatuh_tempo ? $bahan->tanggal_jatuh_tempo->format('Y-m-d') : '-' }}</td>
                                        <td>
                                            <a href="{{ route('bahan.edit', $bahan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('bahan.destroy', $bahan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus bahan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Tidak ada data bahan.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>
             </main>
        </div> 
    </div>
        <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('bahan.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Bahan Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Bahan</label>
                            <input type="text" name="nama_bahan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Bahan</label>
                            <input type="text" name="jenis_bahan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori" class="form-select">
                                <option value="Bahan Baku">Bahan Baku</option>
                                <option value="Pengemasan">Pengemasan</option>
                                <option value="Alat">Alat</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah Stok</label>
                            <input type="number" name="jumlah_stok" class="form-control" value="0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Satuan</label>
                            <select name="satuan" class="form-select">
                                <option value="kg">kg</option>
                                <option value="gram">gram</option>
                                <option value="sak">sak</option>
                                <option value="kantong">kantong</option>
                                <option value="pouch">pouch</option>
                                <option value="botol">botol</option>
                                <option value="sisir">sisir</option>
                                <option value="bungkus">bungkus</option>
                                <option value="lembar">lembar</option>
                                <option value="liter">liter</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="text" class="form-control input-harga" 
                                        id="harga_display" 
                                        data-target="harga" 
                                        value="{{ number_format($bahan->harga, 0, ',', '.') }}">

                            <input type="hidden" name="harga" id="harga" value="{{ $bahan->harga }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stok Minimum</label>
                            <input type="number" name="stok_minimum" class="form-control" value="0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Metode Pembayaran</label>
                            <select name="metode_pembayaran" class="form-select" onchange ="toggleJatuhTempo(this.value)" required>
                                <option value="cash">Cash</option>
                                <option value="tempo">Tempo</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jatuh Tempo</label>
                            <input type="date" name="tanggal_jatuh_tempo" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
            
        </tr>
            </tbody>
        </table>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/format-rupiah.js') }}"></script>
    </body>
</html>


                                                        