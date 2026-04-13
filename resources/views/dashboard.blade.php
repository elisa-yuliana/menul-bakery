<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <style>
        body {
            font-family: Arial;
            margin: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            background-color: #f2f2f2;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .btn-edit {
            background-color: #3498db;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-tambah {
            background-color: #2ecc71;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
        }

        .menu a {
            margin-right: 10px;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h1>Dashboard</h1>

<div class="menu">
    <a href="/bahan-masuk">📥 Bahan Masuk</a>
    <a href="/bahan-keluar">📤 Bahan Keluar</a>
    <a href="/laporan">📊 Laporan</a>
</div>

<hr>

<h2>Data Bahan</h2>

<p>Total Bahan: {{ $bahans->count() }}</p>

<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Jenis</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Pembayaran</th>
        <th>Tempo</th>
        <th>Stok</th>
    </tr>

    @foreach($bahans as $bahan)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $bahan->nama_bahan }}</td>
        <td>{{ $bahan->jenis_bahan }}</td>
        <td>{{ $bahan->kategori }}</td>

        <!-- HARGA SUDAH FORMAT -->
        <td>Rp {{ number_format($bahan->harga, 0, ',', '.') }}</td>

        <td>{{ $bahan->metode_pembayaran }}</td>
        <td>{{ $bahan->tanggal_jatuh_tempo ?? '-' }}</td>
        <td>{{ $bahan->jumlah_stok }}</td>

        </td>
    </tr>
    @endforeach
</table>

<br>

</body>
</html>