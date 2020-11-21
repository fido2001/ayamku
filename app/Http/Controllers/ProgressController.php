<?php

namespace App\Http\Controllers;

use App\Kandang;
use App\Progress;
use App\Vitamin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $kandang = Kandang::where('user_id', auth()->user()->id)->get();
        $progress = DB::table('data_progress as progress')->join('kandang', 'progress.id_kandang', '=', 'kandang.id')->join('users', 'kandang.user_id', '=', 'users.id')->where('users.id', '=', $user_id)->select('kandang.kode', 'progress.ket_waktu', 'progress.sisa_ternak', 'progress.id')->get();
        return view('progress.index', [
            'dataProgress' => $progress,
            'dataKandang' => $kandang
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

        $progress = Progress::create([
            'id_kandang' => $request->id_kandang,
            'ket_waktu' => date('Y-m-d H:i:s'),
            'sisa_ternak' => $request->sisa_ternak,
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
    public function edit(Progress $progress)
    {
        return view('progress.progress-edit', compact('progress'));
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
        Progress::where('id', $id)->update([
            'id_kandang' => $request->id_kandang,
            'sisa_ternak' => $request->sisa_ternak,
            'perkembangan' => $request->perkembangan,
            'keluhan' => $request->keluhan
        ]);

        return redirect()->route('progress.index')->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Progress::destroy($id);
        return redirect()->route('progress.index')->with('success', 'Data Berhasil Dihapus');
    }

    private function _validation(Request $request)
    {
        $validation = $request->validate(
            [
                'id_kandang' => 'required',
                'sisa_ternak' => 'required|numeric',
                'perkembangan' => 'required'
            ],
            [
                'id_kandang.required' => 'Data tidak boleh kosong, harap diisi',
                'sisa_ternak.required' => 'Data tidak boleh kosong, harap diisi',
                'sisa_ternak.numeric' => 'Sisa ternak tidak boleh melebihi 50 karakter',
                'perkembangan.required' => 'Data tidak boleh kosong, harap diisi',
            ]
        );
    }
}
