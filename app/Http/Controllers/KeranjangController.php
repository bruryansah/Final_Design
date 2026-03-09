<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Keranjang;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;

class KeranjangController extends Controller
{
    /**
     * Menambahkan produk ke keranjang user
     *
     * Langkah-langkah:
     * 1. Mengunci record produk agar stok tidak berubah saat transaksi.
     * 2. Mengecek apakah stok cukup, jika kurang → abort 400.
     * 3. Menyimpan data ke tabel keranjang.
     * 4. Mengurangi stok produk sesuai jumlah yang dibeli.
     *
     * @param \Illuminate\Http\Request $request Request berisi 'produk_id' dan 'jumlah'
     * @return \Illuminate\Http\RedirectResponse Redirect ke halaman keranjang admin
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

            $produk = Produk::lockForUpdate()->findOrFail($request->produk_id);

            // cek stok cukup
            if ($produk->stok < $request->jumlah) {
                abort(400, 'Stok tidak mencukupi');
            }

            // simpan ke keranjang
            Keranjang::create([
                'user_id' => Auth::id(),
                'produk_id' => $request->produk_id,
                'jumlah' => $request->jumlah,
            ]);

            // kurangi stok
            $produk->decrement('stok', $request->jumlah);
        });

        return redirect('/admin/keranjangs');
    }
}
