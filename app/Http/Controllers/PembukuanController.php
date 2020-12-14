<?php

namespace App\Http\Controllers;

use App\Pembukuan;
use Illuminate\Http\Request;

class PembukuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembukuan = Pembukuan::get();
        $pemasukan = Pembukuan::sum('debit');
        $pengeluaran = Pembukuan::sum('kredit');
        return view('pembukuan.index', [
            'dataPembukuan' => $pembukuan,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|max:30',
                'tanggal' => 'required',
                'jenis' => 'required',
                'nominal' => 'required|max:11|regex:/^[0-9]+$/',
                'keterangan' => 'required',
            ],
            [
                'nama.required' => 'Data tidak boleh kosong, harap diisi',
                'nama.max' => 'Maksimal 30 karakter',
                'tanggal.required' => 'Data tidak boleh kosong, harap diisi',
                'jenis.required' => 'Data tidak boleh kosong, harap diisi',
                'nominal.required' => 'Data tidak boleh kosong, harap diisi',
                'nominal.max' => 'Maksimal 11 digit',
                'keterangan.required' => 'Data tidak boleh kosong, harap diisi'
            ]
        );
        if ($request->jenis == 'Pemasukan') {
            Pembukuan::create([
                'nama' => $request->nama,
                'jenis' => $request->jenis,
                'keterangan' => $request->keterangan,
                'tanggal' => $request->tanggal,
                'debit' => $request->nominal
            ]);

            return redirect()->back()->with('success', 'Data Berhasil Disimpan');
        } else {
            Pembukuan::create([
                'nama' => $request->nama,
                'jenis' => $request->jenis,
                'keterangan' => $request->keterangan,
                'tanggal' => $request->tanggal,
                'kredit' => $request->nominal
            ]);

            return redirect()->back()->with('success', 'Data Berhasil Disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pembukuan $pembukuan)
    {
        return view('pembukuan.show', compact('pembukuan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembukuan $pembukuan)
    {
        return view('pembukuan.edit', compact('pembukuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nama' => 'required|max:30',
                'tanggal' => 'required',
                'jenis' => 'required',
                'nominal' => 'required|max:11|regex:/^[0-9]+$/',
                'keterangan' => 'required',
            ],
            [
                'nama.required' => 'Data tidak boleh kosong, harap diisi',
                'nama.max' => 'Maksimal 30 karakter',
                'tanggal.required' => 'Data tidak boleh kosong, harap diisi',
                'jenis.required' => 'Data tidak boleh kosong, harap diisi',
                'nominal.required' => 'Data tidak boleh kosong, harap diisi',
                'nominal.max' => 'Maksimal 11 digit',
                'keterangan.required' => 'Data tidak boleh kosong, harap diisi'
            ]
        );

        if ($request->jenis == 'Pemasukan') {
            Pembukuan::where('id', $id)->update([
                'nama' => $request->nama,
                'jenis' => $request->jenis,
                'keterangan' => $request->keterangan,
                'tanggal' => $request->tanggal,
                'debit' => $request->nominal
            ]);

            return redirect('admin/pembukuan')->with('success', 'Data Berhasil Diubah');
        } else {
            Pembukuan::where('id', $id)->update([
                'nama' => $request->nama,
                'jenis' => $request->jenis,
                'keterangan' => $request->keterangan,
                'tanggal' => $request->tanggal,
                'kredit' => $request->nominal
            ]);

            return redirect('admin/pembukuan')->with('success', 'Data Berhasil Diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pembukuan::destroy($id);
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
}
