@extends('layouts.app')

@section('content')
                <div class="card shadow">
                    <div class="card-header text-primary d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Stok Bahan Roti</h5>
                        <div>
                            <button type="button" class="btn btn-primary btn-sm fw-bold text-light " data-bs-toggle="modal" data-bs-target="#modalTambah">
                                + Tambah Bahan
                            </button>
                        </div>
                    </div>
                    <div class="card-header text-primary d-flex justify-content-between align-items-center">
                        <div class="input-group">
                            <input type="text" id="cariBahan" class="form-control" placeholder="Ketik nama bahan untuk mencari...">
                            <span class="input-group-text bg-primary text-white">
                                <img src="{{ ('img\icons\search.svg') }}" class=" align-items-center icon-putih">
                            </span>
                        </div>
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
                                    @php 
                                        $No = 1; 
                                        // Ambil tanggal besok untuk pembanding
                                        $besok = \Carbon\Carbon::now()->addDay()->toDateString();
                                    @endphp

                                    @forelse($bahans as $bahan)
                                        @php
                                            // Logika: Kuning jika statusnya 'tempo' DAN tanggalnya adalah besok
                                            $infoTempo = ($bahan->metode_pembayaran == 'tempo' && 
                                                        optional($bahan->tanggal_jatuh_tempo)->toDateString() == $besok);
                                        @endphp

                                        <tr class="{{ $infoTempo ? 'table-warning' : '' }}">
                                            <td>{{ $No++ }}</td>
                                            <td>{{ $bahan->nama_bahan }}</td>
                                            <td>{{ $bahan->jenis_bahan }}</td>
                                            <td>{{ $bahan->kategori }}</td>
                                            <td>
                                                {{ $bahan->jumlah_stok }} 
                                                {{ 
                                                    $bahan->satuan == 'gram' ? 'G' : 
                                                    ($bahan->satuan == 'liter' ? 'L' : 
                                                    ($bahan->satuan == 'kg' ? 'Kg' : ucfirst($bahan->satuan))) 
                                                }}
                                            </td>
                                            <td>Rp {{ number_format($bahan->harga, 0, ',', '.') }}</td>
                                            <td>{{ $bahan->stok_minimum }}</td>
                                            <td>
                                                {{-- Tambah sedikit badge agar lebih rapi --}}
                                                <span class="badge {{ $bahan->metode_pembayaran == 'tempo' ? 'bg-danger' : 'bg-success' }}">
                                                    {{ $bahan->metode_pembayaran }}
                                                </span>
                                            </td>
                                            <td>{{ $bahan->tanggal_jatuh_tempo ? $bahan->tanggal_jatuh_tempo->format('d-m-Y') : '-' }}</td>
                                            <td>
                                                <a href="{{ route('bahan.edit', $bahan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $bahan->id }}">
                                                    Hapus
                                                </button>
                                            </td>
                                            <div class="modal fade" id="modalHapus{{ $bahan->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <p>Apakah Anda yakin ingin menghapus bahan <strong>{{ $bahan->nama_bahan }}</strong>?</p>
                                                            <p class="text-muted small">Tindakan ini tidak dapat dibatalkan dan akan menghapus histori terkait bahan ini.</p>
                                                        </div>
                                                        <div class="modal-footer justify-content-center">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <form action="{{ route('bahan.destroy', $bahan->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-success">Ya, Hapus Data</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center">Tidak ada data bahan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>
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
                                <option value="Kg">Kg</option>
                                <option value="G">G</option>
                                <option value="Sak">Sak</option>
                                <option value="Kantong">Kantong</option>
                                <option value="Pouch">Pouch</option>
                                <option value="Botol">Botol</option>
                                <option value="Sisir">Sisir</option>
                                <option value="Bungkus">Bungkus</option>
                                <option value="Lembar">Lembar</option>
                                <option value="L">L</option>
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
@endsection
        @push('scripts')
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/format-rupiah.js') }}"></script>
        <script src="{{ asset('js/search-bahan.js') }}"></script>
        @endpush
    </body>
</html>


                                                        