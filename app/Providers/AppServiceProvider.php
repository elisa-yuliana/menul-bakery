<?php

namespace App\Providers;
use App\Models\Bahan;
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
        $hSeminggu = Carbon::now()->addDay(7)->toDateString();
        $stoklimit = Bahan::whereColumn('jumlah_stok','<=','stok_minimum')->count(); 
        
        $jumlahJatuhTempo = Bahan::whereNotNull('tanggal_jatuh_tempo')
                                 ->where('tanggal_jatuh_tempo', '<=', $hSeminggu )
                                 ->count();

        $view->with('totalNotifikasi', $stoklimit + $jumlahJatuhTempo);
    });
}
}
