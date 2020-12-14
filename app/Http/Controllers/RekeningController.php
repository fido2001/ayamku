<?php

namespace App\Http\Controllers;

use App\Rekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rekening = Rekening::get();
        return view('admin.rekening', ['dataRekening' => $rekening]);
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
        Rekening::create($request->all());
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
    public function edit(Rekening $rekening)
    {
        return view('admin.rekening-edit', compact('rekening'));
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
        Rekening::where('id', $id)->update([
            'nama_bank' => $request->nama_bank,
            'nama_pemilik' => $request->nama_pemilik,
            'no_rekening' => $request->no_rekening
        ]);

        return redirect('admin/rekening')->with('success', 'Data Berhasil Disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rekening::destroy($id);
        return redirect()->route('rekening.index')->with('success', 'Data Berhasil Dihapus');
    }

    private function _validation(Request $request)
    {
        $validation = $request->validate(
            [
                'nama_bank' => 'required|max:20|min:3',
                'nama_pemilik' => 'required|max:30|min:3',
                'no_rekening' => 'required|min:10|max:16|regex:/^[0-9]+$/'
            ],
            [
                'nama_bank.required' => 'Data tidak boleh kosong, harap diisi',
                'nama_bank.max' => 'Data tidak boleh melebihi 20 karakter',
                'nama_bank.min' => 'Data minimal 3 karakter',
                'nama_pemilik.required' => 'Data tidak boleh kosong, harap diisi',
                'nama_pemilik.max' => 'Data tidak boleh melebihi 30 karakter',
                'nama_pemilik.min' => 'Data minimal 3 karakter',
                'no_rekening.required' => 'Data tidak boleh kosong, harap diisi',
                'no_rekening.max' => 'Data tidak boleh melebihi 16 karakter',
                'no_rekening.min' => 'Data minimal 10 karakter',
            ]
        );
    }
}
