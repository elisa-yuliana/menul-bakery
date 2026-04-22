<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanMasuk;
use App\Models\BahanKeluar;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
{
    // ambil input tanggal
    $start = $request->start_date;
    $end = $request->end_date;

    // ================== MASUK ==================
    $masukQuery = BahanMasuk::with('bahan');

    if ($start && $end) {
        $masukQuery->whereBetween('tanggal_masuk', [$start, $end]);
    }

    $masuk = $masukQuery->get()->map(function($item){
        return [
            'tanggal' => $item->tanggal_masuk,
            'nama_bahan' => $item->bahan->nama_bahan,
            'jumlah' => $item->jumlah_masuk,
            'jenis' => 'Masuk',
            'harga' => $item->bahan->harga,
            'metode' => $item->bahan->metode_pembayaran
        ];
    });

    // ================== KELUAR ==================
    $keluarQuery = BahanKeluar::with('bahan');

    if ($start && $end) {
        $keluarQuery->whereBetween('tanggal_keluar', [$start, $end]);
    }

    $keluar = $keluarQuery->get()->map(function($item){
        return [
            'tanggal' => $item->tanggal_keluar,
            'nama_bahan' => $item->bahan->nama_bahan,
            'jumlah' => $item->jumlah_keluar,
            'jenis' => 'Keluar',
            'harga' => $item->bahan->harga,
            'metode' => $item->bahan->metode_pembayaran
        ];
    });

    $laporan = collect($masuk)
        ->concat($keluar)
        ->sortByDesc('tanggal')
        ->values();

    return view('laporan.index', compact('laporan', 'start', 'end'));
}
    public function exportPdf(Request $request)
    {
        $start = $request->start_date;
        $end = $request->end_date;


        $masukQuery = BahanMasuk::with('bahan');

        if ($start && $end) {
            $masukQuery->whereBetween('tanggal_masuk', [$start, $end]);
        }

        $masuk = $masukQuery->get()->map(function($item){
            return [
                'tanggal' => $item->tanggal_masuk,
                'nama_bahan' => $item->bahan->nama_bahan,
                'jumlah' => $item->jumlah_masuk,
                'jenis' => 'Masuk'
            ];
        });

        $keluarQuery = BahanKeluar::with('bahan');

        if ($start && $end) {
            $keluarQuery->whereBetween('tanggal_keluar', [$start, $end]);
        }
        $keluar = $keluarQuery->get()->map(function($item){
            return [
                'tanggal' => $item->tanggal_keluar,
                'nama_bahan' => $item->bahan->nama_bahan,
                'jumlah' => $item->jumlah_keluar,
                'jenis' => 'Keluar'
            ];
        });

        $laporan = collect($masuk)
            ->concat($keluar)
            ->sortByDesc('tanggal')
            ->values();

        $pdf = Pdf::loadView('laporan.pdf', compact('laporan'));
        return $pdf->download('laporan_bahan.pdf');
    }
}