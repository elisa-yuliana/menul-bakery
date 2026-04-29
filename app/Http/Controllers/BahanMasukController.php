<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bahan;
use App\Models\BahanMasuk;

class BahanMasukController extends Controller
{
   public function index(Request $request)
{
    $bahans = Bahan::all(); 

    // 1. Ambil query dasar dengan relasi
    $query = BahanMasuk::with('bahan')->latest();

    // 2. Logika Filter
    if ($request->has('all')) {
        // Jika klik "Semua Data", jangan filter berdasarkan tanggal
        $tanggalDipilih = null; 
    } elseif ($request->has('today')) {
        // JIKA KLIK TOMBOL "HARI INI", paksa tanggal ke hari ini (SANGAT PENTING)
        $tanggalDipilih = now()->toDateString();
        $query->whereDate('tanggal_masuk', $tanggalDipilih);
    } else {
        // Jika user memilih tanggal lewat input date, atau default pertama kali buka
        $tanggalDipilih = $request->get('filter_tanggal', now()->toDateString());
        $query->whereDate('tanggal_masuk', $tanggalDipilih);
    }

    // 3. Eksekusi query
    $data = $query->get();

    return view('bahan_masuk.index', compact('data', 'bahans', 'tanggalDipilih'));
}
    public function store(Request $request)
{
    // 1. Validasi Data
    $request->validate([
        'bahan_id' => 'required|exists:bahans,id',
        'jumlah_masuk' => 'required|numeric|min:1',
        'tanggal_masuk' => 'required|date',
    ]);

    // 2. Ambil data bahan dari database untuk mendapatkan stok saat ini
    $bahan = Bahan::findOrFail($request->bahan_id);
    
    // Tentukan variabel pendukung
    $stokAwal = $bahan->jumlah_stok; // Ini adalah angka SEBELUM ditambah
    $jumlahMasuk = $request->jumlah_masuk;
    $stokSekarang = $stokAwal + $jumlahMasuk; // Ini adalah hasil kalkulasi

    // 3. Simpan ke Tabel Bahan Masuk (Snapshot Data)
    BahanMasuk::create([
        'bahan_id' => $request->bahan_id,
        'stok_awal' => $stokAwal,    // Mengambil dari variabel $stokAwal
        'jumlah_masuk' => $jumlahMasuk,
        'stok_sekarang' => $stokSekarang, // Mengambil dari variabel $stokAkhir
        'tanggal_masuk' => $request->tanggal_masuk,
    ]);

    // 4. UPDATE STOK DI TABEL BAHAN
    // Kita gunakan nilai $stokAkhir yang sudah dihitung tadi
    $bahan->jumlah_stok = $stokSekarang;
    $bahan->save();

    return redirect()->back()->with('success', 'Data bahan masuk berhasil disimpan!');
}
}