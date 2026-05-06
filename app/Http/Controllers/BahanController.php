<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bahan;

class BahanController extends Controller
{
    public function index()
    {
        $bahans = Bahan::all();
        return view('bahan.index', compact('bahans'));
        
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_bahan' => 'required',
            'jenis_bahan'=> 'required',
            'kategori' => 'required',
            'jumlah_stok' => 'required|numeric',
            'satuan' => 'required',
            'harga' => 'required|numeric',
            'stok_minimum' => 'required|numeric',
            'metode_pembayaran' => 'required',
        ]);

        if ($request->metode_pembayaran == 'cash') {
            $request['tanggal_jatuh_tempo'] = null;
        }

            Bahan::create($request->all());

        return redirect()->route('bahan.index')->with('success', 'Bahan berhasil ditambahkan.');
    }
    public function edit($id)
    {
        $bahan = Bahan::findOrFail($id);
        return view('bahan.edit', compact('bahan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bahan' => 'required',
            'jenis_bahan'=> 'required',
            'kategori' => 'required',
            'jumlah_stok' => 'required|numeric',
            'satuan' => 'required',
            'harga' => 'required|numeric',
            'stok_minimum' => 'required|numeric',
            'metode_pembayaran' => 'required',
        ]);
        if ($request->metode_pembayaran == 'cash') {
            $request['tanggal_jatuh_tempo'] = null;
        }

        $bahan = Bahan::findOrFail($id);
        $bahan->update($request->all());

        return redirect()->route('bahan.index')->with('success', 'Data diperbarui!');
    }

    public function destroy($id)
    {
        $bahan = Bahan::findOrFail($id);
        $bahan->delete();

        return redirect()->route('bahan.index')->with('success', 'Data dihapus!');
    }
}