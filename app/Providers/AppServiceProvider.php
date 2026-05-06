<?php

namespace App\Providers;
use App\Models\Bahan; // Pastikan nama model sesuai
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    View::composer('*', function ($view) {
        // Hitung bahan yang stoknya di bawah minimum
        $besok = Carbon::now()->addDay()->toDatestring();
        $jumlahStokLimit = Bahan::whereColumn('jumlah_stok', '<', 'stok_minimum')->count();
        $stoklimit = Bahan::whereColumn('jumlah_stok','<=','stok_minimum')->count(); 
        
        // Hitung bahan yang sudah jatuh tempo atau jatuh tempo hari ini
        $jumlahJatuhTempo = Bahan::whereNotNull('tanggal_jatuh_tempo')
                                 ->where('tanggal_jatuh_tempo', '<=', $besok )
                                 ->count();

        $view->with('totalNotifikasi', $stoklimit + $jumlahJatuhTempo);
    });
}
}
