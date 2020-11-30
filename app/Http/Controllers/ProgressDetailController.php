<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Progress;
use App\ProgressDetail;
use App\Vitamin;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProgressDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $progress = Progress::join('kandang', 'kandang.id', '=', 'progress.id_kandang')->where('progress.id', '=', $id)->select('progress.*')->get();

        $progressDetail = ProgressDetail::join('progress', 'progress.id', '=', 'progress_detail.id_progress')->join('kandang', 'kandang.id', '=', 'progress.id_kandang')->where('progress.id', '=', $id)->select('progress_detail.*', 'progress.*', 'kandang.*')->get();

        // dd($progress, $progressDetail);

        $vitamin = Vitamin::get();

        $kategori = Kategori::get();

        return view('progress.progress-detail', [
            'progressDetail' => $progressDetail,
            'dataProgress' => $progress,
            'dataVitamin' => $vitamin,
            'dataKategori' => $kategori
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
        Carbon::setTestNow('2020-12-01');
        $this->_validation($request);

        $tgl_progress = Carbon::now()->setTimezone('Asia/Jakarta');

        $progress = ProgressDetail::create([
            'id_progress' => $request->id_progress,
            'id_vitamin' => $request->id_vitamin,
            'id_kategori' => $request->id_kategori,
            'banyak_telur' => $request->banyak_telur,
            'jumlah_ternak' => $request->jumlah_ternak,
            'jumlah_pakan' => $request->jumlah_pakan,
            'ternak_mati' => $request->ternak_mati,
            'ket_waktu' => $request->ket_waktu,
            'tgl_progress' => $tgl_progress,
            'perkembangan' => $request->perkembangan
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function _validation(Request $request)
    {
        $validation = $request->validate(
            [
                'jumlah_ternak' => 'required|integer|between:1,9999',
                'ternak_mati' => 'required|integer|between:1,9999',
                'perkembangan' => 'required'
            ],
            [
                'jumlah_ternak.required' => 'Data tidak boleh kosong, harap diisi',
                'ternak_mati.required' => 'Data tidak boleh kosong, harap diisi',
                'perkembangan.required' => 'Data tidak boleh kosong, harap diisi'
            ]
        );
    }
}
