@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header"><h4>Edit Data Kecamatan</h4></div>
        <form method="post" action="{{ route('kecamatan.update', $kecamatan) }}" class="needs-validation" novalidate="">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{ $kecamatan->id }}">
            <div class="card-body">
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label>Nama Kecamatan</label>
                        <input type="text" class="form-control" name="nama_kecamatan" value="{{ $kecamatan->nama_kecamatan }}" required="">
                        <div class="invalid-feedback">
                            Data tidak boleh kosong, harap diisi.
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection