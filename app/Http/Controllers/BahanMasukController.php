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

            // 1. Ambil query dasar
            $query = BahanMasuk::with('bahan')->latest();

            // 2. Cek apakah user ingin melihat "Semua Data"
            if ($request->has('all')) {
                $tanggalDipilih = null; // Kosongkan input tanggal di view
            } else {
                // Jika tidak klik "Semua", gunakan filter tanggal (default: hari ini)
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