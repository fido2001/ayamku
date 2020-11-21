@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header"><h4>Edit Data Kategori</h4></div>
        <form method="post" action="{{ route('kategori.update', $kategori) }}" class="needs-validation" novalidate="">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{ $kategori->id }}">
            <div class="card-body">
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label>Kriteria Bobot</label>
                        <input type="text" class="form-control" name="bobot" value="{{ $kategori->bobot }}" required="">
                        <div class="invalid-feedback">
                            Data tidak boleh kosong, harap diisi.
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('kategori.index') }}" class="btn btn-warning">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection