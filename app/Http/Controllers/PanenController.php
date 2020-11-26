<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Panen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PanenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Carbon::setTestNow('2020-12-26');
        $user_id = auth()->user()->id;
        $panen = DB::table('data_panen as panen')->join('data_progress as progress', 'panen.id_progress', '=', 'progress.id')->join('kandang', 'progress.id_kandang', '=', 'kandang.id')->join('users', 'kandang.user_id', '=', 'users.id')->where('users.id', '=', $user_id)->select('panen.*')->get();
        $progress = DB::table('data_progress as progress')->join('kandang', 'progress.id_kandang', '=', 'kandang.id')->join('users', 'kandang.user_id', '=', 'users.id')->where('users.id', '=', $user_id)->select('kandang.kode', 'progress.sisa_ternak', 'progress.id', 'progress.tgl_selesai')->get();
        // dd($panen, $progress);
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

        $panen = Panen::create([
            'id_progress' => $request->id_progress,
            'id_kategori' => $request->id_kategori,
            'lama_panen' => $request->lama_panen,
            'total_ternak' => $request->total_ternak,
            'tanggal' => date('Y-m-d')
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
                'lama_panen' => 'required|numeric',
                'total_ternak' => 'required|numeric'
            ],
            [
                'id_progress.required' => 'Data tidak boleh kosong, harap diisi. Atau belum masuk waktu panen',
                'id_kategori.required' => 'Data tidak boleh kosong, harap diisi',
                'lama_panen.required' => 'Data tidak boleh kosong, harap diisi',
                'lama_panen.numeric' => 'Data harus angka',
                'total_ternak.required' => 'Data tidak boleh kosong, harap diisi',
                'total_ternak.numeric' => 'Data harus angka',
            ]
        );
    }
}
