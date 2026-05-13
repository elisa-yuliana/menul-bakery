<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanMasuk;
use App\Models\BahanKeluar;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    private function getLaporanData($start, $end)
    {
        $masukQuery = BahanMasuk::with('bahan');
        $keluarQuery = BahanKeluar::with('bahan');

        if ($start && $end) {
            $masukQuery->whereBetween('tanggal_masuk', [$start, $end]);
            $keluarQuery->whereBetween('tanggal_keluar', [$start, $end]);
        }

        $masuk = $masukQuery->get()->map(function($item) {
            return [
                'id' => $item->id,
                'tanggal' => $item->tanggal_masuk,
                'nama_bahan' => $item->bahan->nama_bahan,
                'jumlah' => $item->jumlah_masuk,
                'satuan' => $item->bahan->satuan,
                'jenis' => 'Masuk',
                'harga' => $item->bahan->harga,
                'metode' => $item->bahan->metode_pembayaran,
                'stok_sekarang' => $item->stok_sekarang,
                'stok_minimum' => $item->bahan->stok_minimum,
                'tanggal_jatuh_tempo' => $item->bahan->tanggal_jatuh_tempo,
                'created_at' => $item->created_at
            ];
        });

        $keluar = $keluarQuery->get()->map(function($item) {
            return [
                'id' => $item->id,
                'tanggal' => $item->tanggal_keluar,
                'nama_bahan' => $item->bahan->nama_bahan,
                'jumlah' => $item->jumlah_keluar,
                'satuan' => $item->bahan->satuan,
                'jenis' => 'Keluar',
                'harga' => $item->bahan->harga,
                'metode' => $item->bahan->metode_pembayaran,
                'stok_sekarang' => $item->stok_sekarang,
                'stok_minimum' => $item->bahan->stok_minimum,
                'tanggal_jatuh_tempo' => $item->bahan->tanggal_jatuh_tempo,
                'created_at' => $item->created_at
            ];
        });

        return collect($masuk)->concat($keluar)->sortBy('created_at')->values();
    }

    public function index(Request $request)
    {
        $start = $request->input('start_date', now()->format('Y-m-d'));
        $end = $request->input('end_date', now()->format('Y-m-d'));

        $laporan = $this->getLaporanData($start, $end);

        return view('laporan.index', [
            'laporan' => $laporan,
            'start' => $start,
            'end' => $end
        ]);
    }
    public function exportPdf(Request $request)
    {
        $start = $request->input('start_date', now()->format('Y-m-d'));
        $end = $request->input('end_date', now()->format('Y-m-d'));
        $laporan = $this->getLaporanData($start, $end);
        $pdf = Pdf::loadView('laporan.pdf', compact('laporan', 'start', 'end'));
        $pdf->setPaper('a4', 'portrait');
        return $pdf->download('laporan_stok_'.$start.'_to_'.$end.'.pdf');
    }
}