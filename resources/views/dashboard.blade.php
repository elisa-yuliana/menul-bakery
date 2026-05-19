@extends('layouts.app')

@section('content')
<!-- Bagian yang dilihat semua orang (Staff & Admin) -->
<div class="d-flex align-items-center justify-content-end p-3" style="border-bottom: 2px solid #e3e6f0;">
    <div class="text-end me-3">
        <p class="mb-0 small font-weight-bold text-dark">{{ Auth::user()->name }}</p>
        <small class="text-muted" style="font-size: 10px;">{{ strtoupper(Auth::user()->role) }}</small>
    </div>
    <div class="profile-picture">
        <img src="{{ asset('img/icons/person-circle.svg') }}" width="35" height="35" class="rounded-circle">
    </div>
</div>
    <div class="container mt-4">
        <h1 class="mb-4">Dashboard</h1>
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card card-custom text-dark border-primary bg-light shadow mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Total Bahan</h5>
                        <div class="d-flex align-items-baseline">
                            <h2 class="display-4 mb-0 fw-bold">{{ $bahans->count() }}</h2>
                            <span class="ms-2 fs-5 text-dark">Jenis</span>
                        </div>
                            <span class="icon-right-bottom">
                                <img src="{{ asset('img/icons/box-seam-fill.svg') }}" class="icon-custom">
                            </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom text-dark border-success bg-light shadow mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-success">Bahan Masuk</h5>
                        <div class="d-flex align-items-baseline">
                            <h2 class="display-4 mb-0 fw-bold">{{ $bahanMasuk }}</h2>
                            <span class="ms-2 fs-5 text-white-100">Jenis</span>
                        </div>
                            <span class="icon-right-bottom">
                                <img src="{{ asset('img/icons/inbox-fill.svg') }}" class="icon-custom">
                            </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom text-dark border-danger bg-light shadow mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Bahan Keluar</h5>
                        <div class="d-flex align-items-baseline">
                            <h2 class="display-4 mb-0 fw-bold">{{ $bahanKeluar }}</h2>
                            <span class="ms-2 fs-5 text-white-100">Jenis</span>
                        </div>
                            <span class="icon-right-bottom">
                                <img src="{{ asset('img/icons/dropbox.svg') }}" class="icon-custom">
                            </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row g-4">

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

    if (password.type === "password") {
        password.type = "text";
    } else {
        password.type = "password";
    }
}

function toggleConfirmPassword() {
    const confirmPassword =
        document.getElementById("confirmPassword");

    if (confirmPassword.type === "password") {
        confirmPassword.type = "text";
    } else {
        confirmPassword.type = "password";
    }
}
</script>

</body>
</html>