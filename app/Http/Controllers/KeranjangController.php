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
        // Menambahkan ke keranjang TIDAK mengurangi stok
        $request->validate([
            'produk_id' => 'required|integer|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        Keranjang::create([
            'user_id' => Auth::id(),
            'produk_id' => $request->produk_id,
            'jumlah' => $request->jumlah,
        ]);

        return redirect('/admin/keranjangs');
    }

    public function destroy($id)
    {
        // Hapus item keranjang milik user sebelum checkout
        $item = Keranjang::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $item->delete();
        return back()->with('success', 'Item di keranjang telah dihapus.');
    }

    public function checkout(Request $request)
    {
        // Proses checkout: baru mengurangi stok dan membuat pembelian
        DB::transaction(function () {
            $userId = Auth::id();
            $items = Keranjang::where('user_id', $userId)->get();

            foreach ($items as $item) {
                $produk = Produk::lockForUpdate()->findOrFail($item->produk_id);

                if ($produk->stok < $item->jumlah) {
                    abort(400, 'Stok tidak mencukupi untuk produk: ' . $produk->nama);
                }

                // Buat pembelian per item keranjang
                \App\Models\Pembelian::create([
                    'kode_pembelian' => 'P-' . $produk->id . '-' . preg_replace('/\s+/', '', Auth::user()->name) . '-' . now()->format('YmdHis') . '-' . substr(uniqid(), -6),
                    'produk_id' => $produk->id,
                    'banyak' => $item->jumlah,
                    'bayar' => (int)$produk->harga * (int)$item->jumlah,
                    'user_id' => $userId,
                    'status' => 'Verifikasi',
                ]);

                // Kurangi stok sekarang (saat checkout)
                $produk->decrement('stok', $item->jumlah);
            }

            // Bersihkan keranjang setelah checkout sukses
            Keranjang::where('user_id', $userId)->delete();
        });

        return redirect('/admin/pembelians')->with('success', 'Checkout berhasil. Pembelian telah dibuat.');
    }
}
