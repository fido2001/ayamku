<?php

namespace App\Http\Controllers;

use App\Kandang;
use Illuminate\Http\Request;

class KandangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kandang = Kandang::get();
        return view('peternak.kandang', ['kandang' => $kandang]);
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
        request()->validate(
            [
                'kode' => ['required'],
                'panjang' => ['required'],
                'lebar' => ['required'],
                'jumlahBibit' => ['required']
            ],
            [
                'kode.required' => 'Data tidak boleh kosong, harap diisi!',
                'panjang.required' => 'Data tidak boleh kosong, harap diisi!',
                'lebar.required' => 'Data tidak boleh kosong, harap diisi!',
                'jumlahBibit.required' => 'Data tidak boleh kosong, harap diisi!',
            ]
        );

        $attr = $request->all();

        auth()->user()->kandang()->create($attr);

        session()->flash('success', 'Data Kandang berhasil ditambahkan.');

        return redirect()->route('kandang.index');
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
    public function edit(Kandang $kandang)
    {
        return view('peternak.kandang-edit', compact('kandang'));
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
        Kandang::where('id', $id)->update([
            'kode' => $request->kode,
            'panjang' => $request->panjang,
            'lebar' => $request->lebar,
            'jumlahBibit' => $request->jumlahBibit
        ]);

        return redirect()->route('kandang.index')->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kandang::destroy($id);
        return redirect()->back()->with('success', 'Data kandang berhasil dihapus.');
    }
}
