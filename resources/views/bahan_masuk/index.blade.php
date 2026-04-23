@extends('layouts.app')

@section('content')
                <div class="card shadow">
                    <div class="card-header text-success d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Daftar Bahan Masuk</h3>
                        <div class="header-actions d-flex align-items-center py-1 mt-2">
                            <form action="{{ route('bahan_masuk.index') }}" method="GET" class="filter-form">
                                <input type="date" name="filter_tanggal" class="input-date border-dark" 
                                        value="{{ $tanggalDipilih }}" onchange="this.form.submit()">
                                <a href="{{ route('bahan_masuk.index') }}" class="btn btn-light border-dark btn-sm fw-bold text-dark">
                                    Hari Ini
                                </a>
                                <button type="submit" name="all" value="true" class="btn btn-light border-dark btn-sm fw-bold text-dark">
                                    Semua Data
                                </button>
                                <button type="button" class="btn btn-light border-dark btn-sm fw-bold text-dark" data-bs-toggle="modal" data-bs-target="#modalTambahBahan">
                                + Tambah Bahan Masuk
                                </button>
                            </form>
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
                                            <th>Tanggal</th>
                                            <th>Bahan</th>
                                            <th>Jumlah</th>
                                        </tr>
                                </thead>
                                    <tbody>
                                         @forelse($data as $index => $d)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $d->tanggal_masuk }}</td>
                                                <td>{{ $d->bahan->nama_bahan }}</td>
                                                <td>{{ $d->jumlah_masuk }}</td>
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
                
                <div class="modal fade" id="modalTambahBahan" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Bahan Baru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('bahan_masuk.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Cari Bahan</label>
                                        <select name="bahan_id" class="form-select js-select2" style="width: 100%" required>
                                            <option value="">-- Ketik Nama Bahan --</option>
                                            @foreach($bahans as $bahan)
                                                <option value="{{ $bahan->id }}">{{ $bahan->nama_bahan }}</option>
                                            @endforeach
                                        </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Jumlah Masuk</label>
                                    <input type="number" name="jumlah_masuk" class="form-control" placeholder="0" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal_masuk" class="form-control" value="{{ date('Y-m-d') }}" required>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endsection

            @push('scripts')
            <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('js/format-rupiah.js') }}"></script>
            <script src="{{ asset('js/jquery.min.js') }}"></script>
            <script src="{{ asset('js/select2.min.js') }}"></script>
            <script>
                $(document).ready(function() {
                    $('.js-select2').select2({
                        dropdownParent: $('#modalTambahBahan'),
                        placeholder: "Pilih Bahan",
                        allowClear: true
                    });
                });
            </script>
            @endpush
        </div>
    </div>
</body>
</html>
