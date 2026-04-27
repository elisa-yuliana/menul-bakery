@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header text-danger d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Daftar Bahan Keluar</h3>

        <div class="header-actions d-flex align-items-center py-1 mt-2">
            <form action="{{ route('bahan_keluar.index') }}" method="GET" class="filter-form">

            <input type="date"
                name="filter_tanggal"
                class="input-date border-dark"
                value="{{ $tanggalDipilih ?? date('Y-m-d') }}"
                onchange="this.form.submit()">

                <button type="submit" name="today" value="true" 
                    class="btn btn-light border-dark btn-sm fw-bold text-dark">
                    Hari ini
                </button>

                <button type="submit" name="all" value="true"
                    class="btn btn-light border-dark btn-sm fw-bold text-dark">
                    Semua Data
                </button>

                <button type="button"
                    class="btn btn-light border-dark btn-sm fw-bold text-dark"
                    data-bs-toggle="modal"
                    data-bs-target="#modalKeluar">
                    + Tambah Bahan Keluar
                </button>
            </form>
        </div>
    </div>

            @if(session('success'))
                <div class="alert alert-success m-3">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger m-3">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Bahan</th>
                                <th>Jumlah Stok Awal</th>
                                <th>Jumlah Stok Keluar</th>
                                <th>jumlah total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $d)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($d->tanggal_keluar)->format('d-m-Y') }}</td>
                                <td>{{ $d->bahan->nama_bahan }}</td>
                                <td>{{ $d->bahan->jumlah_stok + $d->jumlah_keluar }}</td>
                                <td>{{ $d->jumlah_keluar }}</td>
                                <td>{{ $d->bahan->jumlah_stok}}</td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada data bahan keluar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

<div class="modal fade" id="modalKeluar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Tambah Bahan Keluar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <form action="{{ route('bahan_keluar.store') }}" method="POST">
            @csrf
            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label">Cari Bahan</label>
                    <select name="bahan_id" class="form-select js-select2" style="width: 100%" required>
                        <option value="">-- Ketik Nama Bahan --</option>
                        @foreach($bahans as $bahan)
                            <option value="{{ $bahan->id }}">
                                {{ $bahan->nama_bahan }}
                            </option>
                        @endforeach
                    </select>
                </div>
             <div class="mb-3">
                        <label class="form-label">Jumlah Keluar</label>
                        <input type="number" name="jumlah_keluar" class="form-control" placeholder="0" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal_keluar" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-danger">
                            Simpan Data
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.js-select2').select2({
            dropdownParent: $('#modalKeluar'),
            placeholder: "Pilih Bahan",
            allowClear: true
        });
    });
</script>
@endpush
