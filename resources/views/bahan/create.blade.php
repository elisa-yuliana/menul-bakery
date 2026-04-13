@extends('layouts.app')

@section('content')

<h2>➕ Tambah Bahan</h2>

<style>
    .form-box {
        max-width: 500px;
        margin: 20px auto;
        padding: 20px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    input, select {
        width: 100%;
        padding: 8px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    .btn-submit {
        width: 100%;
        padding: 10px;
        background-color: #2ecc71;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
    }

    .btn-submit:hover {
        background-color: #27ae60;
    }

    .btn-back {
        display: inline-block;
        margin-top: 15px;
        padding: 8px 12px;
        background-color: #7f8c8d;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }
</style>

<div class="form-box">

    <form action="/bahan/store" method="POST">
        @csrf

        <div class="form-group">
            <label>Nama Bahan</label>
            <input type="text" name="nama_bahan" required>
        </div>

        <div class="form-group">
            <label>Jenis Bahan</label>
            <input type="text" name="jenis_bahan" required>
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <input type="text" name="kategori" required>
        </div>

        <div class="form-group">
            <label>Jumlah Stok</label>
            <input type="number" name="jumlah_stok" required>
        </div>

        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" required>
        </div>

        <div class="form-group">
            <label>Stok Minimum</label>
            <input type="number" name="stok_minimum" required>
        </div>

        <div class="form-group">
            <label>Metode Pembayaran</label>
            <select name="metode_pembayaran">
                <option value="cash">Cash</option>
                <option value="tempo">Tempo</option>
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Jatuh Tempo</label>
            <input type="date" name="tanggal_jatuh_tempo">
        </div>

        <button type="submit" class="btn-submit">Simpan</button>
    </form>

    <a href="/bahan" class="btn-back">⬅️ Kembali ke Data Bahan</a>

</div>

@endsection