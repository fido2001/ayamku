<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Panen;
use App\Progress;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PanenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Carbon::setTestNow('2020-12-20');

        $user_id = auth()->user()->id;

        $panen = Panen::join('kategori', 'kategori.id', '=', 'data_panen.id_kategori')->join('data_progress as progress', 'data_panen.id_progress', '=', 'progress.id')->join('kandang', 'progress.id_kandang', '=', 'kandang.id')->join('users', 'kandang.user_id', '=', 'users.id')->where('users.id', '=', $user_id)->select('data_panen.*', 'kategori.bobot')->get();

        $progress = Progress::join('kandang', 'data_progress.id_kandang', '=', 'kandang.id')->join('users', 'kandang.user_id', '=', 'users.id')->where('users.id', '=', $user_id)->select('kandang.kode', 'data_progress.sisa_ternak', 'data_progress.id', 'data_progress.tgl_selesai')->get();

        $dataKategori = Kategori::get();
        return view('panen.index', compact('panen', 'progress', 'dataKategori'));
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
        $this->_validation($request);

        $tgl_panen = Carbon::now()->setTimezone('Asia/Jakarta');

        $panen = Panen::create([
            'id_progress' => $request->id_progress,
            'id_kategori' => $request->id_kategori,
            'total_ternak' => $request->total_ternak,
            'tanggal' => $tgl_panen
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Panen $panen)
    {
        $dataKategori = Kategori::get();
        return view('panen.panen-edit', compact('panen', 'dataKategori'));
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
        $this->_validation($request);

        Panen::where('id', $id)->update([
            'id_progress' => $request->id_progress,
            'id_kategori' => $request->id_kategori,
            'lama_panen' => $request->lama_panen,
            'total_ternak' => $request->total_ternak,
            'tanggal' => $request->tanggal
        ]);

        return redirect()->route('panen.index')->with('success', 'Data Berhasil Disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Panen::destroy($id);
        return redirect()->route('panen.index')->with('success', 'Data Berhasil Dihapus');
    }

    private function _validation(Request $request)
    {
        $validation = $request->validate(
            [
                'id_progress' => 'required',
                'id_kategori' => 'required',
                'usia_ternak' => 'required|numeric',
                'total_ternak' => 'required|numeric'
            ],
            [
                'id_progress.required' => 'Data tidak boleh kosong, harap diisi. Atau belum masuk waktu panen',
                'id_kategori.required' => 'Data tidak boleh kosong, harap diisi',
                'usia_ternak.required' => 'Data tidak boleh kosong, harap diisi',
                'usia_ternak.numeric' => 'Data harus angka',
                'total_ternak.required' => 'Data tidak boleh kosong, harap diisi',
                'total_ternak.numeric' => 'Data harus angka',
            ]
        );
    }
}
