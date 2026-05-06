<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bahan;
use App\Models\BahanKeluar;

class BahanKeluarController extends Controller
{
    public function index(Request $request)
{
    $bahans = Bahan::all(); 

    // 1. Ambil query dasar dengan relasi
    $query = BahanKeluar::with('bahan')->oldest();

    // 2. Logika Filter
    if ($request->has('all')) {
        // Jika klik "Semua Data", jangan filter berdasarkan tanggal
        $tanggalDipilih = null; 
    } elseif ($request->has('today')) {
        // JIKA KLIK TOMBOL "HARI INI", paksa tanggal ke hari ini (SANGAT PENTING)
        $tanggalDipilih = now()->toDateString();
        $query->whereDate('tanggal_keluar', $tanggalDipilih);
    } else {
        // Jika user memilih tanggal lewat input date, atau default pertama kali buka
        $tanggalDipilih = $request->get('filter_tanggal', now()->toDateString());
        $query->whereDate('tanggal_keluar', $tanggalDipilih);
    }

    // 3. Eksekusi query
    $data = $query->get();

    return view('bahan_keluar.index', compact('data', 'bahans', 'tanggalDipilih'));
}
    public function store(Request $request)
{
    // 1. Validasi Data
    $request->validate([
        'bahan_id' => 'required|exists:bahans,id',
        'jumlah_keluar' => 'required|numeric|min:1',
        'tanggal_keluar' => 'required|date',
    ]);

    // 2. Ambil data bahan dari database untuk mendapatkan stok saat ini
    $bahan = Bahan::findOrFail($request->bahan_id);
    
    // Tentukan variabel pendukung
    $stokAwal = $bahan->jumlah_stok; // Ini adalah angka SEBELUM ditambah
    $jumlahKeluar = $request->jumlah_keluar;
    $stokSekarang = $stokAwal - $jumlahKeluar; // Ini adalah hasil kalkulasi

    // 3. Simpan ke Tabel Bahan Masuk (Snapshot Data)
    BahanKeluar::create([
        'bahan_id' => $request->bahan_id,
        'stok_awal' => $stokAwal,    // Mengambil dari variabel $stokAwal
        'jumlah_keluar' => $jumlahKeluar,
        'stok_sekarang' => $stokSekarang, // Mengambil dari variabel $stokAkhir
        'tanggal_keluar' => $request->tanggal_keluar,
    ]);

    // 4. UPDATE STOK DI TABEL BAHAN
    // Kita gunakan nilai $stokAkhir yang sudah dihitung tadi
    $bahan->jumlah_stok = $stokSekarang;
    $bahan->save();

    return redirect()->back()->with('success', 'Data bahan keluar berhasil disimpan!');
}
}