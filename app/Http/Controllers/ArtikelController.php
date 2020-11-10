<?php

namespace App\Http\Controllers;

use App\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('artikel.artikel', [
            'artikel' => Artikel::latest()->paginate(6),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('artikel.artikel-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);
        $attr = $request->all();
        $slug = \Str::slug(request('title'));
        $attr['slug'] = $slug;

        if (request()->file('image')) {
            $thumbnail = request()->file('image')->store("images/artikel");
        } else {
            $thumbnail = null;
        }

        $attr['thumbnail'] = $thumbnail;

        auth()->user()->artikel()->create($attr);

        session()->flash('success', 'Artikel berhasil dibuat.');

        return redirect()->route('artikel.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Artikel $artikel)
    {
        // $artikel = Artikel::where('slug', $artikel->slug)->get();
        return view('artikel.artikel-show', compact('artikel', 'artikel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Artikel $artikel)
    {
        return view('artikel.artikel-edit', [
            'artikel' => $artikel
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        if (request()->file('thumbnail')) {
            \Storage::delete($artikel->thumbnail);
            $thumbnail = request()->file('thumbnail')->store("images/artikel");
        } else {
            $thumbnail = $artikel->thumbnail;
        }


        $attr = $request->all();
        $attr['user_id'] = auth()->id();
        $attr['thumbnail'] = $thumbnail;

        $artikel->update($attr);

        session()->flash('success', 'Data berhasil disimpan.');

        return redirect()->route('artikel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artikel $artikel)
    {
        \Storage::delete($artikel->thumbnail);
        $artikel->delete();
        session()->flash('success', 'Sebuah artikel berhasil dihapus.');
        return redirect()->route('artikel.index');
    }
}
