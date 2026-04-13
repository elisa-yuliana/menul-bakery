@extends('layouts.app')

@section('content')

<h3>Riwayat Bahan Keluar</h3>

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

    .button-group {
        margin-top: 20px;
        display: flex;
        gap: 10px;
    }

    .btn {
        text-decoration: none;
        padding: 8px 14px;
        border-radius: 6px;
        color: white;
        font-size: 14px;
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
        <th>Nama Bahan</th>
        <th>Jumlah Keluar</th>
        <th>Tanggal</th>
    </tr>

@foreach($data as $item)
<tr>
    <td>{{ $item->bahan->nama_bahan }}</td>
    <td>{{ $item->jumlah_keluar }}</td>
    <td>{{ $item->tanggal_keluar }}</td>
</tr>
@endforeach

</table>


@endsection