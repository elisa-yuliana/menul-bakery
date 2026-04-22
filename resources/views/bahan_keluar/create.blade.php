<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Bahan Keluar</title>

    <style>
        body {
            background-color: #f5f6fa;
            font-family: Arial, sans-serif;
        }

        .page-wrapper {
            max-width: 650px;
            margin: 50px auto;
        }

        .form-box {
            padding: 25px;
            background: #f8faf9;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
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
            padding: 10px;
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
    </style>
</head>
<body>

<div class="page-wrapper">
    <div class="form-box">

        <h2> Bahan Keluar</h2>

        <form action="/bahan-keluar/store" method="POST">
            @csrf

            <div class="form-group">
                <label>Bahan</label>
                <select name="bahan_id" class="searchable" required>
                    @foreach($bahans as $bahan)
                        <option value="{{ $bahan->id }}">
                            {{ $bahan->nama_bahan }}
                        </option>
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

    </div>
</div>

</body>
</html>