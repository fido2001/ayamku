<?php

namespace App\Http\Controllers;

use App\Vitamin;
use Illuminate\Http\Request;

class VitaminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vitamin = Vitamin::get();
        return view('admin.vitamin', ['dataVitamin' => $vitamin]);
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
        Vitamin::create($request->all());
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
    public function edit(Vitamin $vitamin)
    {
        return view('admin.vitamin-edit', compact('vitamin'));
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
        Vitamin::where('id', $id)->update([
            'jenis_vitamin' => $request->jenis_vitamin,
            'takaran' => $request->takaran,
            'syarat' => $request->syarat
        ]);

        return redirect()->route('vitamin.index')->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vitamin::destroy($id);
        return redirect()->route('vitamin.index')->with('success', 'Data Berhasil Dihapus');
    }

    private function _validation(Request $request)
    {
        $validation = $request->validate(
            [
                'jenis_vitamin' => 'required|max:50|min:3',
                'takaran' => 'required|max:50|min:3',
                'syarat' => 'required|max:50|min:3'
            ],
            [
                'jenis_vitamin.required' => 'Nama kecamatan harus diisi',
                'jenis_vitamin.max' => 'Nama kecamatan tidak boleh melebihi 50 karakter',
                'jenis_vitamin.min' => 'Nama kecamatan minimal 3 karakter',
                'takaran.required' => 'Nama kecamatan harus diisi',
                'takaran.max' => 'Nama kecamatan tidak boleh melebihi 50 karakter',
                'takaran.min' => 'Nama kecamatan minimal 3 karakter',
                'syarat.required' => 'Nama kecamatan harus diisi',
                'syarat.max' => 'Nama kecamatan tidak boleh melebihi 50 karakter',
                'syarat.min' => 'Nama kecamatan minimal 3 karakter'
            ]
        );
    }
}
