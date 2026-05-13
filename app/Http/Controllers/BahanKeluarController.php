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
    $query = BahanKeluar::with('bahan')->oldest();
    if ($request->has('all')) {
        $tanggalDipilih = null; 
    } elseif ($request->has('today')) {
        $tanggalDipilih = now()->toDateString();
        $query->whereDate('tanggal_keluar', $tanggalDipilih);
    } else {
        $tanggalDipilih = $request->get('filter_tanggal', now()->toDateString());
        $query->whereDate('tanggal_keluar', $tanggalDipilih);
    }

    $data = $query->get();

    return view('bahan_keluar.index', compact('data', 'bahans', 'tanggalDipilih'));
}
    public function store(Request $request)
{

    $request->validate([
        'bahan_id' => 'required|exists:bahans,id',
        'jumlah_keluar' => 'required|numeric|min:1',
        'tanggal_keluar' => 'required|date',
    ]);

    $bahan = Bahan::findOrFail($request->bahan_id);
    $stokAwal = $bahan->jumlah_stok;
    $jumlahKeluar = $request->jumlah_keluar;
    $stokSekarang = $stokAwal - $jumlahKeluar;

    BahanKeluar::create([
        'bahan_id' => $request->bahan_id,
        'stok_awal' => $stokAwal,  
        'jumlah_keluar' => $jumlahKeluar,
        'stok_sekarang' => $stokSekarang,
        'tanggal_keluar' => $request->tanggal_keluar,
    ]);
    $bahan->jumlah_stok = $stokSekarang;
    $bahan->save();

    return redirect()->back()->with('success', 'Data bahan keluar berhasil disimpan!');
}
}