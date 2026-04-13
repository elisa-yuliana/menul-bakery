@extends('layouts.app')

@section('content')

<h3>Data Bahan Masuk</h3>

<!-- Tombol tambah -->
<a href="/bahan-masuk/create" class="btn tambah">+ Tambah</a>

<style>
    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 15px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }

    .btn {
        text-decoration: none;
        padding: 8px 14px;
        border-radius: 6px;
        color: white;
        font-size: 14px;
        display: inline-block;
        margin-top: 10px;
    }

    .tambah {
        background-color: #3498db;
    }

    .button-group {
        margin-top: 20px;
        display: flex;
        gap: 10px;
    }

    .back-dashboard {
        background-color: #7f8c8d;
    }

    .back-bahan {
        background-color: #2ecc71;
    }

    .btn:hover {
        opacity: 0.85;
    }
</style>

<table>
<tr>
    <th>Tanggal</th>
    <th>Bahan</th>
    <th>Jumlah</th>
</tr>

@foreach($data as $d)
<tr>
    <td>{{ $d->tanggal_masuk }}</td>
    <td>{{ $d->bahan->nama_bahan }}</td>
    <td>{{ $d->jumlah_masuk }}</td>
</tr>
@endforeach

</table>

@endsection