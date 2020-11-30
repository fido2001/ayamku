@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header"><h4>Edit Data Kandang</h4></div>
        <form method="post" action="{{ route('kandang.update', $kandang) }}" class="needs-validation" novalidate="">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{ $kandang->id }}">
            <div class="card-body">
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label>Nama Kandang</label>
                        <input type="text" class="form-control @error('nama_kandang') is-invalid @enderror" name="nama_kandang" value="{{ $kandang->nama_kandang }}">
                        @error('nama_kandang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="jenis_kandang">Jenis Kandang</label>
                            <select name="jenis_kandang" class="form-control" id="jenis_kandang">
                                <option value="Pembibitan">Pembibitan</option>
                                <option value="Produksi">Produksi</option>              
                            </select>
                            @error('jenis_kandang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label>Panjang Kandang</label>
                        <input type="number" min="1" step="1" id="panjang" class="input form-control @error('panjang') is-invalid @enderror" name="panjang" value="{{ $kandang->panjang }}">
                        @error('panjang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label>Lebar Kandang</label>
                        <input type="number" min="1" step="1" id="lebar" class="input form-control @error('lebar') is-invalid @enderror" name="lebar" value="{{ $kandang->lebar }}">
                        @error('lebar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label>Jumlah Koloni</label>
                        <input type="number" min="1" step="1" class="form-control @error('jumlah_koloni') is-invalid @enderror" name="jumlah_koloni" value="{{ $kandang->jumlah_koloni }}">
                        @error('jumlah_koloni')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('kandang.index') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
@endsection
