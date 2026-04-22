<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bahan;
use App\Models\BahanKeluar;

class BahanKeluarController extends Controller
{
    public function index()
    {
        $data = BahanKeluar::with('bahan')->get();
        $bahans = Bahan::all();

        return view('bahan_keluar.index', compact('data', 'bahans'));
    }
    public function create()
{
    $bahans = Bahan::all();
    return view('bahan_keluar.create', compact('bahans'));
}
    //simpan data
    public function store(Request $request)
    {
        $request->validate([
            'bahan_id' => 'required',
            'jumlah_keluar' => 'required|numeric',
            'tanggal_keluar' => 'required|date',
        ]);

        $bahan = Bahan::find($request->bahan_id);

            // cek stok
            if ($request->jumlah_keluar > $bahan->jumlah_stok) {
                return back()->with('error', 'Stok tidak cukup!');
            }

            // simpan transaksi
            BahanKeluar::create($request->all());

            //kurangi stok
            $bahan->jumlah_stok -= $request->jumlah_keluar;
            $bahan->save();

            return redirect('/bahan-keluar')->with('success', 'Bahan keluar berhasil');
    }
}