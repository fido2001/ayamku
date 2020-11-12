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
                        <label>Kode Kandang</label>
                        <input type="text" class="form-control" name="kode" value="{{ $kandang->kode }}" required="">
                        <div class="invalid-feedback">
                            Data tidak boleh kosong, harap diisi!
                        </div>
                    </div>
                </div>
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label>Panjang Kandang</label>
                        <input type="number" class="input form-control" name="panjang" value="{{ $kandang->panjang }}" required="">
                        <div class="invalid-feedback">
                            Data tidak boleh kosong, harap diisi!
                        </div>
                    </div>
                </div>
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label>Lebar Kandang</label>
                        <input type="number" class="input form-control" name="lebar" value="{{ $kandang->lebar }}" required="">
                        <div class="invalid-feedback">
                            Data tidak boleh kosong, harap diisi!
                        </div>
                    </div>
                </div>
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label>Jumlah Ternak</label>
                        <input type="number" class="form-control" name="jumlahBibit" value="{{ $kandang->jumlahBibit }}" required="">
                        <div class="invalid-feedback">
                            Data tidak boleh kosong, harap diisi!
                        </div>
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