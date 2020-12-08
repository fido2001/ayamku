<?php

namespace App\Http\Controllers;

use App\Order;
use App\Pembukuan;
use App\Produk;
use App\ProgressDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProdukController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;

        // $produk = Produk::join('data_panen as pn', 'produk.id_panen', '=', 'pn.id')->where('produk.id_panen', '=', 'pn.id')->get();
        $produk = DB::table('produk as pr')->join('progress_detail as prdt', 'pr.id_progress_detail', '=', 'prdt.id')->select('pr.*', 'prdt.tgl_progress', 'prdt.banyak_telur')->get();
        // dd($produk);
        $progress = ProgressDetail::get();

        // dd($progress);

        return view('produk.index', [
            'dataProduk' => $produk,
            'dataProgress' => $progress
        ]);
    }

    public function indexDistributor()
    {
        $produk = Produk::where('jumlah_produk', '>', 0)->get();

        return view('produk.indexDistributor', ['dataProduk' => $produk]);
    }

    public function show(Produk $produk)
    {
        $alamat_mitra = User::where('id_role', 1)->value('alamat');

        return view('produk.showDistributor', compact('produk', 'alamat_mitra'));
    }

    public function sale(Produk $produk)
    {
        $alamat_mitra = User::where('id_role', 1)->value('alamat');
        return view('produk.sale', compact('produk', 'alamat_mitra'));
    }

    public function purchase(Request $request)
    {
        if ($request->banyak_item >= 100 and $request->jenis_pengiriman == 'Diantar') {
            $nominalKirim = ($request->harga * $request->banyak_item) + ($request->banyak_item * 1000);
            $nominal = ($request->harga * $request->banyak_item);
            $order = Order::create([
                'id_produk' => $request->id_produk,
                'id_users' => $request->id_users,
                'tanggal' => Carbon::now()->setTimezone('Asia/Jakarta'),
                'batas_pembayaran' => Carbon::now()->setTimezone('Asia/Jakarta')->addHours(24),
                'status_order' => 'Menunggu Pembayaran',
                'nominal' => $nominalKirim,
                'banyak_item' => $request->banyak_item,
                'jenis_pengiriman' => $request->jenis_pengiriman
            ]);

            $pembukuan = Pembukuan::create([
                'tanggal' => Carbon::now()->setTimezone('Asia/Jakarta'),
                'nama' => 'Penjualan Online',
                'keterangan' => 'Penjualan online dengan jenis pengiriman (diantar)',
                'debit' => $nominal,
                'jenis' => 'Pemasukan'
            ]);

            return redirect('distributor/produk')->with('success', 'Produk berhasil dipesan, segera lakukan pembayaran');
        } elseif ($request->banyak_item < 100 and $request->jenis_pengiriman == 'Diantar') {
            return redirect()->back()->with('warning', 'Minimun pembelian tidak mencukupi untuk pengiriman');
        } elseif ($request->banyak_item < 100 and $request->jenis_pengiriman == 'Ambil Sendiri') {
            $nominal = $request->harga * $request->banyak_item;
            $order = Order::create([
                'id_produk' => $request->id_produk,
                'id_users' => $request->id_users,
                'tanggal' => Carbon::now()->setTimezone('Asia/Jakarta'),
                'batas_pembayaran' => Carbon::now()->setTimezone('Asia/Jakarta')->addHours(24),
                'status_order' => 'Menunggu Pembayaran',
                'nominal' => $nominal,
                'banyak_item' => $request->banyak_item,
                'jenis_pengiriman' => $request->jenis_pengiriman
            ]);

            $pembukuan = Pembukuan::create([
                'tanggal' => Carbon::now()->setTimezone('Asia/Jakarta'),
                'nama' => 'Penjualan Online',
                'keterangan' => 'Penjualan online dengan jenis pengiriman (ambil sendiri)',
                'debit' => $nominal,
                'jenis' => 'Pemasukan'
            ]);

            return redirect('distributor/produk')->with('success', 'Produk berhasil dipesan, segera lakukan pembayaran');
        }
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
