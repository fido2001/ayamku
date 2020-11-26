<?php

namespace App\Http\Controllers;

use App\Produk;
use App\Panen;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;

        $produk = Produk::join('data_panen', 'data_panen.id', '=', 'produk.id_panen')->join('users', 'users.id', '=', 'produk.id_user')->join('kategori', 'kategori.id', '=', 'data_panen.id_kategori')->where('produk.id_user', '=', 'users.id')->select('produk.*', 'users.*', 'data_panen.*', 'kategori.bobot')->get();

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

        $user_id = auth()->user()->id;

        $produk = Produk::create([
            'id_user' => $user_id,
            'id_panen' => $request->id_panen,
            'harga' => $request->harga,
            'jumlah_produk' => $request->jumlah_produk
        ]);
    }
}
