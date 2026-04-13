@extends('layouts.app')

@section('content')

<h2>✏️ Edit Bahan</h2>

<form action="/bahan/{{ $bahan->id }}" method="POST" class="form-container">
    @csrf
    @method('PUT')

    <label>Nama Bahan</label>
    <input type="text" name="nama_bahan" value="{{ $bahan->nama_bahan }}" required>

    <label>Jenis Bahan</label>
    <input type="text" name="jenis_bahan" value="{{ $bahan->jenis_bahan }}" required>

    <label>Kategori</label>
    <input type="text" name="kategori" value="{{ $bahan->kategori }}" required>

    <label>Jumlah Stok</label>
    <input type="number" name="jumlah_stok" value="{{ $bahan->jumlah_stok }}" required>

    <label>Satuan</label>
    <select name="satuan" required>
        <option value="pcs" {{ $bahan->satuan == 'pcs' ? 'selected' : '' }}>pcs</option>
        <option value="kg" {{ $bahan->satuan == 'kg' ? 'selected' : '' }}>kg</option>
        <option value="sak" {{ $bahan->satuan == 'sak' ? 'selected' : '' }}>sak</option>
        <option value="liter" {{ $bahan->satuan == 'liter' ? 'selected' : '' }}>liter</option>
    </select>

    <label>Harga</label>
    <input type="number" name="harga" value="{{ $bahan->harga }}" required>

    <label>Stok Minimum</label>
    <input type="number" name="stok_minimum" value="{{ $bahan->stok_minimum }}" required>

    <label>Metode Pembayaran</label>
    <select name="metode_pembayaran" required>
        <option value="cash" {{ $bahan->metode_pembayaran == 'cash' ? 'selected' : '' }}>Cash</option>
        <option value="tempo" {{ $bahan->metode_pembayaran == 'tempo' ? 'selected' : '' }}>Tempo</option>
    </select>

    <label>Tanggal Jatuh Tempo</label>
    <input type="date" name="tanggal_jatuh_tempo" value="{{ $bahan->tanggal_jatuh_tempo }}">

    <button type="submit">💾 Simpan Perubahan</button>
</form>

<style>
.form-container {
    max-width: 500px;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
}

input, select {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

button {
    margin-top: 15px;
    background: #3498db;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    width: 100%;
}

button:hover {
    background: #2980b9;
}
</style>

@endsection