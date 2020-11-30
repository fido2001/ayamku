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
                        <label>Jenis Ternak</label>
                        <input type="text" class="form-control @error('jenis_ternak') is-invalid @enderror" name="jenis_ternak" value="{{ $kategori->jenis_ternak }}" required="">
                        @error('jenis_ternak')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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