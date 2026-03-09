<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ProdukCon extends Controller
{
    public function home()
    {
        $produk = DB::table('produks')->get();
        return view('utama', ['produk' => $produk]);
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'stok' => 'required|integer|min:1', // validasi server-side
        ]);

        try {
            $produk->update([
                'stok' => $request->stok,
            ]);
            return redirect()->back()->with('success', 'Stok berhasil diperbarui');
        } catch (QueryException $e) {
            // Tangkap error numeric out of range
            if (! auth()->user()->can('update', [$produk, $request->all()])) {
            return back()->with('error', 'Stok tidak boleh minus!');
            } // lempar error lain
        }
    }

}
