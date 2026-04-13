<!DOCTYPE html>
<html>
<head>
    <title>Laporan PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .masuk {
            colors: green;
            font-weight: bold;
        }

        .keluar {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2>LAPORAN STOK BAHAN</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Bahan</th>
            <th>Jenis</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach($laporan as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item['tanggal'] }}</td>
            <td>{{ $item['nama_bahan'] }}</td>
            <td>
                @if($item['jenis'] == 'Masuk')
                    <span class="masuk">Masuk</span>
                @else
                    <span class="keluar">Keluar</span>
                @endif
            </td>
            <td>{{ $item['jumlah'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<br>
<p style="text-align:right;">Dicetak: {{ date('d-m-Y H:i') }}</p>

</body>
</html>