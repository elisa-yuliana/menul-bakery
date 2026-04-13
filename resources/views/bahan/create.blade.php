<h1>Tambah Bahan</h1>
<a href="/bahan">Kembali ke Daftar Bahan</a>

<form action="/bahan/store" method="POST">
    @csrf

    <label>Nama Bahan: </label><br>
    <input type="text" name="nama_bahan"><required><br>

    <label>Jenis Bahan: </label><br>
    <input type="text" name="jenis_bahan"><required><br>

    <label>Kategori: </label><br>
    <input type="text" name="kategori"><required><br>

    <label>Jumlah Stok: </label><br>
    <input type="number" name="jumlah_stok"><required><br>

    <label>Harga: </label><br>
    <input type="number" name="harga"><required><br>

    <label>Stok Minimum: </label><br>
    <input type="number" name="stok_minimum"><required><br>

    <label>Metode Pembayaran:</label><br>
<select name="metode_pembayaran">
    <option value="cash">Cash</option>
    <option value="tempo">Tempo</option>
</select><br><br>

<label>Tanggal Jatuh Tempo:</label><br>
<input type="date" name="tanggal_jatuh_tempo"><br><br>

    <button type="submit">Simpan</button>
</form>