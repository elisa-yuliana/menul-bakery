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
    $query = BahanMasuk::with('bahan')->oldest();

    if ($request->has('all')) {
        $tanggalDipilih = null; 
    } elseif ($request->has('today')) {
        $tanggalDipilih = now()->toDateString();
        $query->whereDate('tanggal_masuk', $tanggalDipilih);
    } else {
        $tanggalDipilih = $request->get('filter_tanggal', now()->toDateString());
        $query->whereDate('tanggal_masuk', $tanggalDipilih);
    }

    $data = $query->get();

    return view('bahan_masuk.index', compact('data', 'bahans', 'tanggalDipilih'));
}
    public function store(Request $request)
{
    $request->validate([
        'bahan_id' => 'required|exists:bahans,id',
        'jumlah_masuk' => 'required|numeric|min:1',
        'tanggal_masuk' => 'required|date',
        'tanggal_expired'=> 'required|date',
    ]);

    $bahan = Bahan::findOrFail($request->bahan_id);
    $stokAwal = $bahan->jumlah_stok;
    $jumlahMasuk = $request->jumlah_masuk;
    $stokSekarang = $stokAwal + $jumlahMasuk;

    BahanMasuk::create([
        'bahan_id' => $request->bahan_id,
        'stok_awal' => $stokAwal,
        'jumlah_masuk' => $jumlahMasuk,
        'stok_sekarang' => $stokSekarang,
        'tanggal_masuk' => $request->tanggal_masuk,
        'tanggal_expired'=>$request->tanggal_expired,
    ]);
    $bahan->jumlah_stok = $stokSekarang;
    $bahan->save();

    return redirect()->back()->with('success', 'Data bahan masuk berhasil disimpan!');
}
}