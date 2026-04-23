@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Dashboard</h1>
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Bahan</h5>
                        <p class="card-text display-4">{{ $bahans->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Bahan Masuk</h5>
                        <p class="card-text display-4">{{ $bahanMasuk->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Bahan Keluar</h5>
                        <p class="card-text display-4">{{ $bahanKeluar->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-header text-center fw-bold text-white" style="background-color: #ffc107;">
                Bahan Jatuh Tempo (Besok)
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
                                <span class="badge bg-danger">{{ ($item->tanggal_jatuh_tempo)->format('Y-m-d') }}</span>
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
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white">
                                            <h5 class="modal-title">Konfirmasi Pelunasan</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
    
    </div>
@endsection
    @push('scripts')
            <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('js/format-rupiah.js') }}"></script>
            <script src="{{ asset('js/jquery.min.js') }}"></script>
            <script src="{{ asset('js/select2.min.js') }}"></script>
    @endpush