@extends('layouts.app')

@section('content')

<h2>📦 Data Bahan</h2>

@if(session('success'))
    <p class="success">{{ session('success') }}</p>
@endif

<!-- TOMBOL ATAS -->
<div class="top-buttons">
    <a href="/bahan/create" class="btn tambah">+ Tambah Bahan</a>
    <a href="/bahan-masuk/create" class="btn masuk">+ Bahan Masuk</a>
    <a href="/bahan-keluar/create" class="btn keluar">+ Bahan Keluar</a>
    <a href="/bahan-keluar" class="btn riwayat">📋 Riwayat Keluar</a>
</div>

<style>
    .success {
        color: green;
        margin-bottom: 10px;
    }

    .top-buttons {
        margin: 15px 0;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn {
        text-decoration: none;
        padding: 8px 14px;
        border-radius: 6px;
        color: white;
        font-size: 14px;
    }

    .tambah { background-color: #3498db; }
    .masuk { background-color: #2ecc71; }
    .keluar { background-color: #e74c3c; }
    .riwayat { background-color: #9b59b6; }

    .btn:hover {
        opacity: 0.85;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        background: white;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: #f4f6f7;
    }

    .aksi a {
        margin-right: 5px;
        color: blue;
        text-decoration: none;
    }

    .aksi button {
        padding: 5px 8px;
        background-color: red;
        color: white;
        border: none;
        border-radius: 4px;
    }
</style>

<!-- TABEL -->
<table>
    <tr>
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

@foreach($bahans as $bahan)
<tr>
    <td>{{ $bahan->nama_bahan }}</td>
    <td>{{ $bahan->jenis_bahan }}</td>
    <td>{{ $bahan->kategori }}</td>
    <td>{{ $bahan->jumlah_stok }} {{ $bahan->satuan }} </td>
    <td>Rp {{ number_format($bahan->harga, 0, ',', '.') }}</td>
    <td>{{ $bahan->stok_minimum }}</td>
    <td>{{ $bahan->metode_pembayaran }}</td>
    <td>{{ $bahan->tanggal_jatuh_tempo ?? '-' }}</td>

    <td class="aksi">
        <a href="/bahan/{{ $bahan->id }}/edit">Edit</a>

        <form action="/bahan/{{ $bahan->id }}/delete" method="POST" style="display:inline;">
            @csrf
            <button type="submit" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
        </form>
    </td>
</tr>
@endforeach

</table>

@endsection


                                                        