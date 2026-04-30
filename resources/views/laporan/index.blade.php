@extends('layouts.app')

@section('content')
            <div class="container mt-4">
                <div class="report-card">

                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ asset('img/icons/clipboard2-data-fill.svg') }}" 
                             class="me-2"
                             style="width: 24px; height: 24px;">
                        <h2 class="mb-0">Laporan Stok Bahan</h2>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-2">
                            <div class="card border-left-primary shadow h-100 py-0">
                                <div class="card-body">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Transaksi</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $laporan->count() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FILTER -->
                <div class="card shadow">
                    <div class="card-header d-flex align-items-center py-1 mt-2">
                        <form method="GET" action="{{ url('/laporan') }}" class="filter-box">
                            <label>Dari:</label>
                            <input type="date" name="start_date" value="{{ $start ?? '' }}" class="input-date border-dark">

                            <label>Sampai:</label>
                            <input type="date" name="end_date" value="{{ $end ?? '' }}" class="input-date border-dark">

                            <button type="submit" class="btn btn-light border-dark btn-sm fw-bold text-dark">Filter</button>

                            <!-- Menggunakan helper now() Laravel untuk mendapatkan tanggal hari ini -->
                            <a href="{{ route('laporan.index', ['start_date' => now()->format('Y-m-d'), 'end_date' => now()->format('Y-m-d')]) }}" 
                            class="btn btn-info btn-sm fw-bold text-white ">
                            Reset (Hari Ini)
                            </a>

                            <a href="{{ url('/laporan/pdf?start_date='.$start.'&end_date='.$end) }}"  
                            class="btn btn-danger btn-sm fw-bold text-white">
                                <img src="{{ asset('img/icons/file-pdf-fill.svg') }}" class="me-2 icon-putih" 
                                    style="width: 18px; height: 18px;">
                                Export PDF
                            </a>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama Bahan</th>
                                        <th>Jenis</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-end">Harga</th>
                                        <th class="text-center">Stok Sisa</th>
                                        <th class="text-center">Batas Stok</th>
                                        <th>Pembayaran</th>
                                        <th>Jatuh Tempo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($laporan as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item['tanggal'])->format('d/m/Y') }}</td>
                                    <td><strong>{{ strtoupper($item['nama_bahan']) }}</strong></td>
                                    <td class="text-center">
                                        <span class="badge {{ $item['jenis'] == 'Masuk' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $item['jenis'] }}
                                        </span>
                                    </td>
                                    <td class="text-center">{{ $item['jumlah'] }}</td>
                                    <td class="text-end">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                    <td class="text-center fw-bold">
                                        {{ $item['stok_sekarang'] }} 
                                        <span style="font-weight: normal; font-size: 0.85em;">
                                            {{ $item['satuan'] == 'gram' ? 'g' : $item['satuan'] }}
                                        </span>
                                    </td>
                                    <td class="text-center">{{ $item['stok_minimum'] }}</td>
                                    <td>
                                        <span class="badge {{ $item['metode'] == 'tempo' ? 'bg-danger' : 'bg-success' }} rounded-pill">
                                            {{ strtoupper($item['metode']) }}
                                        </span>
                                    </td>
                                    <td>{{ $item['tanggal_jatuh_tempo'] ? \Carbon\Carbon::parse($item['tanggal_jatuh_tempo'])->format('d-m-Y') : '-' }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
                @push('scripts')
                <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('js/format-rupiah.js') }}"></script>
            <script src="{{ asset('js/jquery.min.js') }}"></script>
            <script src="{{ asset('js/select2.min.js') }}"></script>
                @endpush
@endsection