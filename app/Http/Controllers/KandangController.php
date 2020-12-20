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
        return view('admin.kandang', ['kandang' => $kandang]);
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
                'nama_kandang' => ['required'],
                'panjang' => ['required'],
                'lebar' => ['required'],
                'jumlah_koloni' => ['required']
            ],
            [
                'nama_kandang.required' => 'Data tidak boleh kosong, harap diisi!',
                'panjang.required' => 'Data tidak boleh kosong, harap diisi!',
                'lebar.required' => 'Data tidak boleh kosong, harap diisi!',
                'jumlah_koloni.required' => 'Data tidak boleh kosong, harap diisi!',
            ]
        );

        $attr = $request->all();

        $kandang = Kandang::create($attr);

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
        return view('admin.kandang-edit', compact('kandang'));
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
        request()->validate(
            [
                'nama_kandang' => ['required'],
                'panjang' => ['required', 'integer', 'between:1,999'],
                'lebar' => ['required', 'integer', 'between:1,999'],
                'jumlah_koloni' => ['required', 'integer', 'between:1,99999']
            ],
            [
                'nama_kandang.required' => 'Data tidak boleh kosong, harap diisi!',
                'panjang.required' => 'Data tidak boleh kosong, harap diisi!',
                'lebar.required' => 'Data tidak boleh kosong, harap diisi!',
                'jumlah_koloni.required' => 'Data tidak boleh kosong, harap diisi!',
            ]
        );

        Kandang::where('id', $id)->update([
            'nama_kandang' => $request->nama_kandang,
            'jenis_kandang' => $request->jenis_kandang,
            'panjang' => $request->panjang,
            'lebar' => $request->lebar,
            'jumlah_koloni' => $request->jumlah_koloni
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
