<?php

namespace App\Http\Controllers;

use App\Produk;
use App\ProgressDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProdukController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;

        // $produk = Produk::join('data_panen as pn', 'produk.id_panen', '=', 'pn.id')->where('produk.id_panen', '=', 'pn.id')->get();
        $produk = DB::table('produk as pr')->join('progress_detail as prdt', 'pr.id_progress_detail', '=', 'prdt.id')->select('pr.*', 'prdt.*')->get();
        // dd($produk);
        $progress = ProgressDetail::get();

        // dd($progress);

        return view('produk.index', [
            'dataProduk' => $produk,
            'dataProgress' => $progress
        ]);
    }

    public function store(Request $request)
    {
        $tgl_produk = Carbon::now()->setTimezone('Asia/Jakarta');

        // $request->validate([
        //     'nama_produk' => 'required',
        //     'harga' => 'required',
        //     'jumlah_produk' => 'required',
        // ]);

        $produk = Produk::create([
            'id_progress_detail' => $request->id_progress_detail,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'jumlah_produk' => $request->jumlah_produk,
            'tgl_produk' => $tgl_produk
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
