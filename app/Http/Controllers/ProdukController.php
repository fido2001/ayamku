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

    public function purchase(Request $request, $id)
    {
        $stok = Produk::where('id', $id)->value('jumlah_produk');
        if ($request->banyak_item <= $stok) {
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

                return redirect('distributor/produk')->with('success', 'Produk berhasil dipesan, segera lakukan pembayaran');
            }
        } else {
            return redirect()->back()->with('warning', 'Jumlah pembelian melebihi stok.');
        }
    }

    public function historyDistributor()
    {
        $order = Order::join('produk as p', 'p.id', '=', 'order.id_produk')->where('order.id_users', auth()->user()->id)->select('order.*', 'p.nama_produk')->get();
        // dd($order);
        return view('saleProduk.historyDistributor', ['dataOrder' => $order]);
    }

    public function historyAdmin()
    {
        $order = Order::join('produk as p', 'p.id', '=', 'order.id_produk')->where('status_order', '!=', 'Menunggu Pembayaran')->where('batas_pembayaran', '>', Carbon::now()->setTimezone('Asia/Jakarta'))->select('order.*', 'p.nama_produk')->get();

        return view('saleProduk.historyAdmin', ['dataOrder' => $order]);
    }

    public function destroyPesanan($id)
    {
        Order::destroy($id);
        return redirect()->back()->with('success', 'Pesanan Berhasil Dibatalkan.');
    }

    public function historyAdminDetail($id)
    {
        $dataorder = Order::join('produk as p', 'p.id', '=', 'order.id_produk')->join('users', 'order.id_users', '=', 'users.id')->where('order.id', $id)->select('order.*', 'p.nama_produk', 'p.harga', 'users.name', 'users.alamat')->get();
        // dd($tenggat);
        return view('saleProduk.historyAdmin-detail', ['dataOrder' => $dataorder]);
    }

    public function historyDistributorDetail($id)
    {
        // Carbon::setTestNow('2020-12-10');
        $order = Order::where('id', $id)->first();
        if (Carbon::now()->setTimezone('Asia/Jakarta') > $order->batas_pembayaran) {
            $order->delete();
            return redirect('distributor/rekapPemesanan')->with('fail', 'Pesanan telah dibatalkan, karena pembayaran tidak dilakukan sebelum waktu batas pembayaran habis.');
        } else {
            $dataorder = Order::join('produk as p', 'p.id', '=', 'order.id_produk')->where('order.id', $id)->select('order.*', 'p.nama_produk', 'p.harga')->get();
            // dd($tenggat);
            return view('saleProduk.historyDistributor-detail', ['dataOrder' => $dataorder]);
        }
    }

    public function pembayaran($id)
    {
        $dataorder = Order::join('produk as p', 'p.id', '=', 'order.id_produk')->where('order.id', $id)->select('order.*', 'p.nama_produk', 'p.harga')->get();

        return view('saleProduk.pembayaran', ['dataOrder' => $dataorder]);
    }

    public function storePembayaran(Request $request, $id)
    {
        $request->validate(
            [
                'bukti' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
                'atas_nama' => 'required|max:30',
                'rekening' => 'required|max:15'
            ],
            [
                'bukti.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'atas_nama.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'rekening.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'rekening.max' => 'Maksimal 15 Karakter',
                'atas_nama.max' => 'Maksimal 30 Karakter'
            ]
        );

        $bukti = request()->file('bukti')->store('images/bukti', 'public');

        Order::where('id', $id)->update([
            'rekening' => $request->rekening,
            'atas_nama' => $request->atas_nama,
            'nominal' => $request->nominal,
            'status_order' => 'Belum Terverifikasi',
            'bukti' => $bukti
        ]);

        $pembukuan = Pembukuan::create([
            'tanggal' => Carbon::now()->setTimezone('Asia/Jakarta'),
            'nama' => 'Penjualan Online',
            'keterangan' => 'Penjualan online',
            'debit' => $request->nominal,
            'jenis' => 'Pemasukan'
        ]);

        return redirect('distributor/rekapPemesanan')->with('success', 'Data pembayaran akan segera diproses');
    }

    public function verifikasiBerhasil(Request $request, $id)
    {
        Order::where('id', $id)->update([
            'status_order' => $request->status_order
        ]);

        return redirect()->back()->with('success', 'Verifikasi Berhasil dilakukan.');
    }

    public function verifikasiGagal(Request $request, $id)
    {
        $data = Order::find($id);
        $image_path = public_path() . '/storage/' . $data->bukti;
        unlink($image_path);

        Order::where('id', $id)->update([
            'status_order' => $request->status_order,
            'bukti' => null,
            'rekening' => null,
            'atas_nama' => null,
            'batas_pembayaran' => Carbon::now()->setTimezone('Asia/Jakarta')->addHours(24)
        ]);


        return redirect()->back()->with('success', 'Verifikasi Berhasil dilakukan.');
    }

    public function store(Request $request)
    {
        $tgl_produk = Carbon::now()->setTimezone('Asia/Jakarta');

        $request->validate(
            [
                'nama_produk' => 'required',
                'harga' => 'required',
                'jumlah_produk' => 'required',
            ],
            [
                'nama_produk.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'harga.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'jumlah_produk.required' => 'Semua Form harap diisi dan tidak boleh kosong'
            ]
        );

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
