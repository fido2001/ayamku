<?php

namespace App\Http\Controllers;

use App\Produk;
use App\Panen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;

        // $produk = Produk::join('data_panen as pn', 'produk.id_panen', '=', 'pn.id')->where('produk.id_panen', '=', 'pn.id')->get();
        $produk = DB::table('produk as pr')->join('data_panen as pn', 'pr.id_panen', '=', 'pn.id')->join('kategori as kt', 'pn.id_kategori', '=', 'kt.id')->select('pr.*', 'pn.tanggal', 'kt.bobot')->get();
        // dd($produk);

        $panen = Panen::join('kategori', 'kategori.id', '=', 'data_panen.id_kategori')->join('data_progress as progress', 'data_panen.id_progress', '=', 'progress.id')->join('kandang', 'progress.id_kandang', '=', 'kandang.id')->join('users', 'kandang.user_id', '=', 'users.id')->where('users.id', '=', $user_id)->select('data_panen.*', 'kategori.bobot')->get();

        return view('produk.index', [
            'dataProduk' => $produk,
            'panen' => $panen
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_panen' => 'required',
            'harga' => 'required',
            'jumlah_produk' => 'required',
        ]);

        $produk = Produk::create([
            'id_panen' => $request->id_panen,
            'harga' => $request->harga,
            'jumlah_produk' => $request->jumlah_produk
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Disimpan.');
    }

    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'harga' => 'required'
        ]);

        Produk::where('id', $id)->update([
            'harga' => $request->harga
        ]);
    }

    public function destroy($id)
    {
        Produk::destroy($id);
        return redirect()->back()->with('success', 'Data Berhasil Dihapus.');
    }
}
