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

                <div class="col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-header text-center fw-bold text-white bg-warning mb-0">
                            Bahan Jatuh Tempo (Seminggu)
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm table-striped mb-0">
                                <thead class="bg-light">
                                    <tr class="text-muted" style="font-size: 0.85rem;">
                                        <th class="ps-3">Bahan</th>
                                        <th class="text-center">Tempo</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($datajatuhtempo as $item)
                                    <tr style="font-size: 0.9rem;">
                                        <td class="ps-3 align-middle">{{ $item->nama_bahan }}</td>
                                        <td class="text-center align-middle">
                                            @php
                                                $tglTempo = \Carbon\Carbon::parse($item->tanggal_jatuh_tempo);
                                                $isTelat = $tglTempo->isPast() && !$tglTempo->isToday();
                                            @endphp
                                            
                                            <span class="badge {{ $isTelat ? 'bg-danger' : 'bg-warning text-dark' }}">
                                                {{ $tglTempo->format('d-m-Y') }}
                                                @if($isTelat)
                                                    <strong>(TELAT)</strong>
                                                @endif
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('bahan.edit', $item->id) }}" class="btn btn-warning btn-sm p-0 px-2 text-white">
                                                edit
                                            </a>
                                            <form action="{{ route('bahan.lunas', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                                <button type="button" class="btn btn-success btn-sm p-0 px-2" data-bs-toggle="modal" data-bs-target="#modalLunas{{ $item->id }}">
                                                    <img src="{{ ('img\icons\check-lg.svg') }}" class=" align-items-center icon-putih">
                                                </button>
                                            </form>
                                        </td>
                                        <div class="modal fade" id="modalLunas{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Konfirmasi Pelunasan</h5>
                                                        <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <p>Apakah Anda yakin ingin menandai <strong>{{ $item->nama_bahan }}</strong> sebagai lunas?</p>
                                                        <p class="text-muted small">Status pembayaran akan berubah menjadi cash.</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <form action="{{ route('bahan.lunas', $item->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success">Ya, Tandai Lunas</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-3">Tidak ada data besok</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-header text-center fw-bold text-white bg-danger mb-0">
                            Bahan Limit
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm table-striped mb-0">
                                <thead class="bg-light">
                                    <tr class="text-muted" style="font-size: 0.85rem;">
                                        <th class="ps-3">Bahan</th>
                                        <th class="text-center">Stok</th>
                                        <th class="text-center">Stok Minimum</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($stoklimit as $item)
                                        <tr style="font-size: 0.9rem;">
                                        <td class="ps-3 align-middle">{{ $item->nama_bahan }}</td>
                                            <td class="text-center align-middle">
                                                <span class="badge bg-danger">{{ $item->jumlah_stok }} 
                                                        {{ 
                                                            $item->satuan == 'gram' ? 'g' : 
                                                            ($item->satuan) 
                                                        }}
                                                </span>
                                            </td>
                                        <td>{{ $item->stok_minimum }}</td>
                                            <td class="text-center">
                                                        <a href="{{ route('bahan.edit', $item->id) }}" class="btn btn-warning btn-sm p-0 px-2 text-white">
                                                            edit
                                                        </a>
                                            <button type="button" class="btn btn-success btn-sm p-0 px-2" data-bs-toggle="modal" data-bs-target="#modalTambahBahan{{ $item->id }}">
                                                <img src="{{ asset('img/icons/check-lg.svg') }}" class="align-items-center icon-putih">
                                            </button>
                                        </td>
                                            <div class="modal fade" id="modalTambahBahan{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Tambah Stok Bahan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                        @if ($errors->any())
                                                            <div class="alert alert-danger">
                                                                <ul>
                                                                    @foreach ($errors->all() as $error)
                                                                        <li>{{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif
                                                    <form action="{{ route('bahan_masuk.store', $item->id) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="bahan_id" value="{{ $item->id }}">
                                                    
                                                        <div class="modal-body text-start">
                                                            <div class="mb-3">
                                                                <label class="form-label">Jumlah Masuk</label>
                                                                <input type="number" name="jumlah_masuk" class="form-control" placeholder="0" required>
                                                            </div>

    if (confirmPassword.type === "password") {
        confirmPassword.type = "text";
    } else {
        confirmPassword.type = "password";
    }
}
</script>

</body>
</html>