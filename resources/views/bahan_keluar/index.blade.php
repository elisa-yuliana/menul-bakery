<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menul Bakery</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                        <a class="nav-link text-white bg-secondary active" href="{{ route('bahan_keluar.index') }}">
                            <img src="{{ asset('img/icons/cart-dash-fill.svg') }}" class="me-2 icon-putih"> Bahan Keluar
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{ route('laporan.index') }}">
                            <img src="{{ asset('img/icons/file-earmark-bar-graph-fill.svg') }}" class="me-2 icon-putih"> Laporan
                        </a>
                    </li>
                </ul>
            </nav>

            <main class="col-md-10 ms-sm-auto px-md-4 py-4">
                <div class="card shadow">

                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Bahan Keluar</h5>

                        <button type="button"
                                class="btn btn-light btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalKeluar">
                            + Tambah Bahan Keluar
                        </button>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success m-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Bahan</th>
                                    <th>Jumlah Keluar</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach($data as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->bahan->nama_bahan }}</td>
                                    <td>{{ $item->jumlah_keluar }}</td>
                                    <td>{{ $item->tanggal_keluar }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalKeluar" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="/bahan-keluar/store" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Bahan Keluar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Bahan</label>
                            <select name="bahan_id" class="form-select searchable" required>
                                @foreach($bahans as $bahan)
                                    <option value="{{ $bahan->id }}">
                                        {{ $bahan->nama_bahan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jumlah Keluar</label>
                            <input type="number" name="jumlah_keluar" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Keluar</label>
                            <input type="date" name="tanggal_keluar" class="form-control" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Simpan Data
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <!-- jQuery + Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.searchable').select2({
                dropdownParent: $('#modalKeluar'),
                placeholder: "Cari bahan...",
                width: '100%'
            });
        });
    </script>
</body>
</html>