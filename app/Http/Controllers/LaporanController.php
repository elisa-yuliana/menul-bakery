<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanMasuk;
use App\Models\BahanKeluar;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    // Fungsi bantuan untuk mengambil data agar index dan exportPdf konsisten
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
                'stok_sekarang' => $item->stok_sekarang, // Ambil dari master bahan
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
                'stok_sekarang' => $item->stok_sekarang, // Ambil dari master bahan
                'stok_minimum' => $item->bahan->stok_minimum,
                'tanggal_jatuh_tempo' => $item->bahan->tanggal_jatuh_tempo,
                'created_at' => $item->created_at
            ];
        });

        return collect($masuk)->concat($keluar)->sortBy('created_at')->values();
    }

    public function index(Request $request)
    {
        // Jika start_date kosong, default ke hari ini. Begitu juga dengan end_date.
        $start = $request->input('start_date', now()->format('Y-m-d'));
        $end = $request->input('end_date', now()->format('Y-m-d'));

        // Panggil fungsi data dengan tanggal yang sudah diproses
        $laporan = $this->getLaporanData($start, $end);

        return view('laporan.index', [
            'laporan' => $laporan,
            'start' => $start,
            'end' => $end
        ]);
    }
    public function exportPdf(Request $request)
    {
        // 1. Ambil filter tanggal dari request (agar PDF sesuai dengan filter di layar)
        $start = $request->input('start_date', now()->format('Y-m-d'));
        $end = $request->input('end_date', now()->format('Y-m-d'));

        // 2. Ambil data laporan menggunakan fungsi pembantu yang sudah Anda buat
        $laporan = $this->getLaporanData($start, $end);

        // 3. Load view khusus PDF dan kirimkan datanya
        $pdf = Pdf::loadView('laporan.pdf', compact('laporan', 'start', 'end'));

        // Set ukuran kertas A4 Portrait/Landscape
        $pdf->setPaper('a4', 'portrait');

        // 4. Download file dengan nama yang dinamis
        return $pdf->download('laporan_stok_'.$start.'_to_'.$end.'.pdf');
    }
}