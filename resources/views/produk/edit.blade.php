@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header"><h4>Edit Harga Produk</h4></div>
        <form method="post" action="{{ route('produk.update', $produk) }}" class="needs-validation" novalidate="">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{ $produk->id }}">
            <div class="card-body">
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label>Harga Produk</label>
                        <input type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ $produk->harga }}" required="">
                        @error('harga')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('produk.index.admin') }}" class="btn btn-warning">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection