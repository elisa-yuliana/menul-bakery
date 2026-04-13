<h1>Edit Bahan</h1>

<form action="/bahan/{{ $bahan->id }}/update" method="POST">
    @csrf

    <input type="text" name="nama_bahan" value="{{ $bahan->nama_bahan }}"><br><br>

    <input type="text" name="jenis_bahan" value="{{ $bahan->jenis_bahan }}"><br><br>

    <input type="text" name="kategori" value="{{ $bahan->kategori }}"><br><br>

    <input type="number" name="jumlah_stok" value="{{ $bahan->jumlah_stok }}"><br><br>

    <input type="number" name="harga" value="{{ $bahan->harga }}"><br><br>

    <input type="number" name="stok_minimum" value="{{ $bahan->stok_minimum }}"><br><br>

    <label>Metode Pembayaran</label><br>
    <select name="metode_pembayaran">
        <option value="cash" {{ $bahan->metode_pembayaran == 'cash' ? 'selected' : '' }}>Cash</option>
        <option value="tempo" {{ $bahan->metode_pembayaran == 'tempo' ? 'selected' : '' }}>Tempo</option>
    </select>

    <br><br>

    <label>Tanggal Jatuh Tempo</label><br>
    <input type="date" name="tanggal_jatuh_tempo" value="{{ $bahan->tanggal_jatuh_tempo }}">

    <br><br>

    <button type="submit">Update</button>
</form>