<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bahan;
use App\Models\BahanMasuk;
use App\Models\BahanKeluar;

class DashboardController extends Controller
{
    public function index()
    {
        $bahans = Bahan::all();
        $bahanMasuk = BahanMasuk::all();
        $bahanKeluar = BahanKeluar::all();
        $totalBahan = Bahan::count();

        return view('dashboard', compact(
            'bahans',
            'bahanMasuk',
            'bahanKeluar',
            'totalBahan'
        ));
    }
}