<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use App\Models\Produk;
use App\Models\Pembelian;
use App\Policies\ProdukPolicy;
use App\Policies\PembelianPolicy;

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
        Filament::serving(function () {
            Filament::registerNavigationItems([
                NavigationItem::make('Halaman Utama') // Nama menu
                    ->url(route('homeproduk')) // Route yang dituju
                    ->icon('heroicon-o-link')
                    ->group('shop') // Ikon untuk menu

            ]);
        });
    }
    protected $policies = [
        Produk::class => ProdukPolicy::class,
        Pembelian::class => PembelianPolicy::class,
    ];
}
