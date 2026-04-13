@extends('layouts.app')

@section('content')
<h3>Bahan Keluar</h3>

@if(session('error'))
    <p style="color:red;">{{ session('error') }}</p>
@endif

<form action="/bahan-keluar/store" method="POST">
    @csrf

    <label>Bahan:</label><br>
    <select name="bahan_id">
        @foreach($bahans as $bahan)
            <option value="{{ $bahan->id }}">{{ $bahan->nama_bahan }}</option>
        @endforeach
    </select><br><br>

    <label>Jumlah Keluar:</label><br>
    <input type="number" name="jumlah_keluar"><br><br>

    <label>Tanggal:</label><br>
    <input type="date" name="tanggal_keluar"><br><br>

    <button type="submit">Simpan</button>
</form>
@endsection