<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bahan;
use App\Models\BahanMasuk;

class BahanMasukController extends Controller
{
    public function index()
    {
        $data = BahanMasuk::with('bahan')->get();
        return view('bahan_masuk.index', compact('data'));
    }

    public function create()
    {
        $bahans = Bahan::all();
        return view('bahan_masuk.create', compact('bahans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bahan_id' => 'required',
            'jumlah_masuk' => 'required|numeric',
            'tanggal_masuk' => 'required|date',
        ]);

        $bahan = Bahan::find($request->bahan_id);

        // simpan transaksi
        BahanMasuk::create($request->all());

        // tambah stok
        $bahan->jumlah_stok += $request->jumlah_masuk;
        $bahan->save();

        return redirect('/bahan')->with('success', 'Bahan masuk berhasil');
    }
}