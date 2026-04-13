@extends('layouts.app')

@section('content')
<h3>Bahan Masuk</h3>

<form action="/bahan-masuk/store" method="POST">
    @csrf

    <label>Bahan:</label><br>
    <select name="bahan_id">
        @foreach($bahans as $bahan)
            <option value="{{ $bahan->id }}">{{ $bahan->nama_bahan }}</option>
        @endforeach
    </select><br><br>

    <label>Jumlah Masuk:</label><br>
    <input type="number" name="jumlah_masuk"><br><br>

    <label>Tanggal:</label><br>
    <input type="date" name="tanggal_masuk"><br><br>

    <button type="submit">Simpan</button>
</form>
@endsection