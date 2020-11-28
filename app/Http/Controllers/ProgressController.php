<?php

namespace App\Http\Controllers;

use App\Kandang;
use App\Progress;
use App\Vitamin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProgressController extends Controller
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
        $kandang = Kandang::where('user_id', auth()->user()->id)->get();
        $progress = Progress::join('kandang', 'kandang.id', '=', 'data_progress.id_kandang')->join('users', 'kandang.user_id', '=', 'users.id')->where('users.id', '=', $user_id)->select('data_progress.*', 'kandang.kode')->get();
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
        Carbon::setTestNow('2020-12-27');

        $this->_validation($request);

        $tgl_mulai = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d');

        $tgl_selesai = Carbon::now()->setTimezone('Asia/Jakarta')->addDays($request->lama_siklus);

        $progress_exist = Progress::where([
            ['id_kandang', '=', $request->id_kandang],
            ['tgl_mulai', '=', $tgl_mulai],
            ['lama_siklus', '=', $request->lama_siklus]
        ])->get();

        $progress_berjalan = Progress::where('id_kandang', '=', $request->id_kandang)
            ->where('tgl_mulai', '<=', $tgl_mulai)
            ->where('tgl_selesai', '>=', $tgl_mulai)
            ->get();
        if (count($progress_berjalan) > 0 or count($progress_exist) > 0) {
            return redirect()->back()->with('warning', 'Silakan menyelesaikan progress yang ada.');
        } else {
            $progress = Progress::create([
                'id_kandang' => $request->id_kandang,
                'sisa_ternak' => $request->sisa_ternak,
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'lama_siklus' => $request->lama_siklus
            ]);

            return redirect()->back()->with('success', 'Data Berhasil Disimpan.');
        }
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

        // $tgl_mulai = Carbon::now()->setTimezone('Asia/Jakarta');

        // $tgl_selesai = Carbon::now()->setTimezone('Asia/Jakarta')->addDays($request->lama_siklus);

        Progress::where('id', $id)->update([
            'id_kandang' => $request->id_kandang,
            'sisa_ternak' => $request->sisa_ternak,
            // 'tgl_mulai' => $tgl_mulai,
            // 'tgl_selesai' => $tgl_selesai,
            // 'lama_siklus' => $request->lama_siklus
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
                'sisa_ternak' => 'required|integer|between:1,99999',
                'lama_siklus' => 'required|integer|between:1,50'
            ],
            [
                'id_kandang.required' => 'Data tidak boleh kosong, harap diisi',
                'sisa_ternak.required' => 'Data tidak boleh kosong, harap diisi',
                'lama_siklus.required' => 'Data tidak boleh kosong, harap diisi'
            ]
        );
    }
}
