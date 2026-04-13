@extends('layouts.app')

@section('content')

<h2>📊 Laporan Stok Bahan</h2>

<!-- FILTER TANGGAL -->
<form method="GET" action="{{ url('/laporan') }}">
    Dari:
    <input type="date" name="start_date" value="{{ $start ?? '' }}">

    Sampai:
    <input type="date" name="end_date" value="{{ $end ?? '' }}">

    <button type="submit">Filter</button>

    <a href="/laporan">Reset</a>
</form>

<br>

<!-- EXPORT PDF (INI YANG TADI ERROR) -->
<a href="{{ url('/laporan/pdf?start_date='.$start.'&end_date='.$end) }}" 
   target="_blank" 
   class="btn-export">
   📄 Export PDF
</a>

<br><br>

<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }

    .btn-export {
        padding: 8px 12px;
        background-color: #3498db;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        display: inline-block;
    }

    .jenis-masuk {
        color: green;
        font-weight: bold;
    }

    .jenis-keluar {
        color: red;
        font-weight: bold;
    }

    a.back-btn {
        margin-top: 15px;
        display: inline-block;
        text-decoration: none;
        padding: 6px 10px;
        background-color: #7f8c8d;
        color: white;
        border-radius: 5px;
    }
</style>

<!-- TABEL -->
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Bahan</th>
            <th>Jenis</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Pembayaran</th>
        </tr>
    </thead>
    <tbody>
        @foreach($laporan as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item['tanggal'] }}</td>
            <td>{{ $item['nama_bahan'] }}</td>

            <td>
                @if($item['jenis'] == 'Masuk')
                    <span class="jenis-masuk">Masuk</span>
                @else
                    <span class="jenis-keluar">Keluar</span>
                @endif
            </td>

            <td>{{ $item['jumlah'] }}</td>

            <td>
                Rp {{ number_format($item['harga'], 0, ',', '.') }}
            </td>

            <td>{{ $item['metode'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<br>

<a href="/dashboard" class="back-btn">⬅️ Kembali ke Dashboard</a>

@endsection