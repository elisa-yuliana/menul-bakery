@extends('layouts.app')

@section('content')

<h2>📤 Bahan Keluar</h2>

<style>
    .form-box {
        max-width: 500px;
        margin: 20px auto;
        padding: 20px;
        background: #f8faf9;
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
        border: 1px solid #888787;
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

    .error {
        color: red;
        margin-bottom: 10px;
    }
</style>

<div class="form-box">

    @if(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <form action="/bahan-keluar/store" method="POST">
        @csrf

        <div class="form-group">
            <label>Bahan</label>
            <select name="bahan_id" required>
                @foreach($bahans as $bahan)
                    <option value="{{ $bahan->id }}">{{ $bahan->nama_bahan }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Jumlah Keluar</label>
            <input type="number" name="jumlah_keluar" required>
        </div>

        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal_keluar" required>
        </div>

        <button type="submit" class="btn-submit">Simpan</button>
    </form>

    <a href="/dashboard" class="btn-back">⬅️ Kembali ke Dashboard</a>

</div>

@endsection