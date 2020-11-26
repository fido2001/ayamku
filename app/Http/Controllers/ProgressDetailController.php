<?php

namespace App\Http\Controllers;

use App\Progress;
use App\ProgressDetail;
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
        $user_id = auth()->user()->id;
        $progress = Progress::join('kandang', 'kandang.id', '=', 'data_progress.id_kandang')->join('users', 'kandang.user_id', '=', 'users.id')->where('users.id', '=', $user_id)->where('data_progress.id', '=', $id)->select('data_progress.*')->get();
        $progressDetail = ProgressDetail::join('data_progress', 'data_progress.id', '=', 'progress_detail.id_progress')->join('kandang', 'kandang.id', '=', 'data_progress.id_kandang')->join('users', 'kandang.user_id', '=', 'users.id')->where('users.id', '=', $user_id)->select('progress_detail.*', 'data_progress.*', 'kandang.kode')->get();
        // dd($progressDetail);
        return view('progress.progress-detail', [
            'progressDetail' => $progressDetail,
            'dataProgress' => $progress
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
        $this->_validation($request);

        $tgl_progress = Carbon::now()->setTimezone('Asia/Jakarta');

        $progress = ProgressDetail::create([
            'id_progress' => $request->id_progress,
            'ternak_sehat' => $request->ternak_sehat,
            'ternak_sakit' => $request->ternak_sakit,
            'tgl_progress' => $tgl_progress,
            'perkembangan' => $request->perkembangan,
            'keluhan' => $request->keluhan
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
                'ternak_sehat' => 'required|integer|between:1,99999',
                'ternak_sakit' => 'required|integer|between:1,99999',
                'perkembangan' => 'required'
            ],
            [
                'ternak_sehat.required' => 'Data tidak boleh kosong, harap diisi',
                'ternak_sakit.required' => 'Data tidak boleh kosong, harap diisi',
                'perkembangan.required' => 'Data tidak boleh kosong, harap diisi'
            ]
        );
    }
}
