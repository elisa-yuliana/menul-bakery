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
        $besok = Carbon::now()->addDay()->toDatestring();
        $datajatuhtempo = Bahan::where('metode_pembayaran','tempo')
                                ->whereDate('tanggal_jatuh_tempo',$besok)
                                ->get();
        $stoklimit = Bahan::whereColumn('jumlah_stok','<=','stok_minimum')->get(); 

        $hariIni = Carbon::today();

        // Menghitung berapa jenis bahan yang masuk hari ini
        $bahanMasuk = BahanMasuk::whereDate('tanggal_masuk', $hariIni)
            ->distinct('bahan_id')
            ->count('bahan_id');

        // Menghitung berapa jenis bahan yang keluar hari ini
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