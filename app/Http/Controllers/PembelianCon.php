<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class PembelianCon extends Controller
{
    public function storeinput(Request $request)
    {
        // Validasi input minimal (harga dari client diabaikan seluruhnya)
        $validated = $request->validate([
            'kodeproduk' => 'required|integer|exists:produks,id',
            'banyak' => 'required|integer|min:1',
            'nama_user' => 'nullable|string|max:255',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                // Ambil produk dan kunci barisnya untuk mencegah race condition stok
                $produk = Produk::lockForUpdate()->findOrFail($validated['kodeproduk']);

                // Cek stok cukup
                $qty = (int) $validated['banyak'];
                if ($produk->stok < $qty) {
                    abort(400, 'Stok tidak mencukupi. Sisa stok: ' . (int) $produk->stok);
                }

                // Buat kode pembelian unik
                $username = Auth::check() ? Auth::user()->name : ($validated['nama_user'] ?? 'Guest');
                $kode = 'P-' . $produk->id . '-' . preg_replace('/\s+/', '', $username) . '-' . now()->format('YmdHis') . '-' . substr(Str::uuid()->toString(), -6);

                $userId = Auth::id();
                if (!$userId) {
                    abort(401, 'Sesi login berakhir. Silakan login kembali.');
                }
                $bayar = (int) $produk->harga * $qty;

                // Simpan pembelian
                Pembelian::create([
                    'kode_pembelian' => $kode,
                    'produk_id' => $produk->id,
                    'banyak' => $qty,
                    'bayar' => $bayar,
                    'user_id' => $userId,
                    'status' => 'Verifikasi',
                ]);

                // Kurangi stok
                $produk->decrement('stok', $qty);
            });
        } catch (Throwable $e) {
            Log::error('Gagal membuat pembelian: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return back()->withErrors(['error' => 'Gagal: ' . $e->getMessage()]);
        }

        return redirect('/admin/pembelians')->with('success', 'Pembelian berhasil dibuat.');
    }
}
