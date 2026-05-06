<!DOCTYPE html>
<html>
<head>
    <title>Laporan Stok Bahan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
        .text-end { text-align: right; }
        .badge-masuk { color: green; font-weight: bold; }
        .badge-keluar { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">LAPORAN STOK BAHAN - MENUL BAKERY</h2>
    <p>Periode: {{ \Carbon\Carbon::parse($start)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($end)->format('d-m-Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Bahan</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Stok Sisa</th>
                <th>Batas Stok</th>
                <th>pembayaran</th>
                <th>Jatuh Tempo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item['tanggal'])->format('d/m/Y') }}</td>
                <td>{{ strtoupper($item['nama_bahan']) }}</td>
                <td class="text-center {{ $item['jenis'] == 'Masuk' ? 'badge-masuk' : 'badge-keluar' }}">
                    {{ $item['jenis'] }}
                </td>
                <td class="text-center">{{ $item['jumlah'] }}</td>
                <td class="text-center">{{ $item['stok_sekarang'] }}
                    <span style="font-weight: normal; font-size: 0.85em;">
                        {{ $item['satuan'] == 'gram' ? 'g' : $item['satuan'] }}
                    </span>
                </td>
                <td class="text-center">{{ $item['stok_minimum'] }}</td>
                <td class="text-center">{{ $item['metode'] }}</td>
                <td>{{ $item['tanggal_jatuh_tempo'] ? \Carbon\Carbon::parse($item['tanggal_jatuh_tempo'])->format('d-m-Y') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>