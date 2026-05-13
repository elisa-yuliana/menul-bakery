<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bahan;
use App\Models\BahanMasuk;
use App\Models\BahanKeluar;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $bahans = Bahan::all();
        $bahanMasuk = BahanMasuk::all();
        $bahanKeluar = BahanKeluar::all();
        $totalBahan = Bahan::count();
        $hariIni = Carbon::today();
        $hseminggu = Carbon::now()->addDays(7)->toDateString();
        $datajatuhtempo = Bahan::jatuhTempoKritis($hseminggu)->orderBy('tanggal_jatuh_tempo', 'asc')->get();
        $stoklimit = Bahan::whereColumn('jumlah_stok', '<=', 'stok_minimum')->get();
        $bahanMasuk = BahanMasuk::whereDate('tanggal_masuk', $hariIni)
            ->distinct('bahan_id')
            ->count('bahan_id');

        $bahanKeluar = BahanKeluar::whereDate('tanggal_keluar', $hariIni)
            ->distinct('bahan_id')
            ->count('bahan_id');
            
        return view('dashboard', compact(
            'bahans',
            'bahanMasuk',
            'bahanKeluar',
            'totalBahan',
            'datajatuhtempo',
            'stoklimit'
        ));
    }
    public function tandaiLunas($id)
    {
        $bahan = Bahan::findOrFail($id);

        $bahan->metode_pembayaran = 'cash';
        $bahan->save();
        
        return redirect()->back()->with('success','Tagihan bahan berhasil dilunasi');
    }
}