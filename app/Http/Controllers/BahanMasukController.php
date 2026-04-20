<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bahan;
use App\Models\BahanMasuk;

class BahanMasukController extends Controller
{
   public function index()
    {
        // Mengambil data riwayat bahan masuk untuk tabel
        $data = BahanMasuk::with('bahan')->latest()->get();

        // Mengambil semua daftar bahan untuk pilihan di dropdown modal
        $bahans = Bahan::all(); 

        // Kirim keduanya ke view yang sama
        return view('bahan_masuk.index', compact('data', 'bahans'));
    }
    public function store(Request $request)
    {
        
    // 1. Validasi Data
    $request->validate([
        'bahan_id' => 'required',
        'jumlah_masuk' => 'required|numeric',
        'tanggal_masuk' => 'required|date',
    ]);

    // 2. Simpan ke Tabel Bahan Masuk
    BahanMasuk::create([
        'bahan_id' => $request->bahan_id,
        'jumlah_masuk' => $request->jumlah_masuk,
        'tanggal_masuk' => $request->tanggal_masuk,
    ]);

    // 3. UPDATE STOK DI TABEL BAHAN (PENTING!)
    // Ini agar stok di tabel 'Bahan' juga ikut bertambah otomatis
    $bahan = Bahan::find($request->bahan_id);
    $bahan->jumlah_stok += $request->jumlah_masuk; 
    $bahan->save();

    return redirect()->back()->with('success', 'Data bahan masuk berhasil disimpan!');
    }
}