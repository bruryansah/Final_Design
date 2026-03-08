<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Produk;
use App\Models\Pembelian;
use App\Policies\ProdukPolicy;
use App\Policies\PembelianPolicy;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    protected $policies = [
        Produk::class => ProdukPolicy::class,
        Pembelian::class => PembelianPolicy::class,
    ];
}
