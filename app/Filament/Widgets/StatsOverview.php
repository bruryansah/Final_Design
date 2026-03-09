<?php

namespace App\Filament\Widgets;

use App\Models\Produk;
use App\Models\Pembelian;
use App\Models\Keranjang;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalProduk = Produk::count();

        $totalPembelian = Pembelian::count();

        $totalKeranjang = Keranjang::count();

        // ubah 'total_harga' jika nama kolom berbeda
        $totalPendapatan = Pembelian::sum('bayar');

        return [
            Stat::make('Total Produk', $totalProduk)
                ->description('Produk tersedia')
                ->descriptionIcon('heroicon-m-cube')
                ->color('primary'),

            Stat::make('Total Pembelian', $totalPembelian)
                ->description('Order masuk')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('success'),

            Stat::make('Item di Keranjang', $totalKeranjang)
                ->description('Belum checkout')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('warning'),

            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalPendapatan, 0, ',', '.'))
                ->description('Pendapatan keseluruhan')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
        ];
    }

        public static function canView(): bool
        {
            return Auth::user()->role === 'Admin';
        }
}
