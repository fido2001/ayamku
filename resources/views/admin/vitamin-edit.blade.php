@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header"><h4>Edit Data Vitamin</h4></div>
        <form method="post" action="{{ route('vitamin.update', $vitamin) }}" class="needs-validation" novalidate="">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{ $vitamin->id }}">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2"></div>                               
                    <div class="form-group col-md-8 col-12">
                        <label>Jenis Vitamin</label>
                        <input type="text" class="form-control @error('jenis_vitamin') is-invalid @enderror" name="jenis_vitamin" value="{{ $vitamin->jenis_vitamin }}">
                        @error('jenis_vitamin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="form-group col-md-8 col-12">
                        <label>Takaran</label>
                        <input type="text" class="form-control @error('takaran') is-invalid @enderror" name="takaran" value="{{ $vitamin->takaran }}">
                        @error('takaran')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="form-group col-md-8 col-12">
                        <label>Khasiat</label>
                        <input type="text" class="form-control @error('khasiat') is-invalid @enderror" name="khasiat" value="{{ $vitamin->khasiat }}">
                        @error('khasiat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
            <a href="{{ route('vitamin.index') }}" class="btn btn-warning">Batal</a>
            <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
@endsection