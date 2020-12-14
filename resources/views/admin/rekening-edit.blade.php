@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header"><h4>Edit Data Rekening</h4></div>
        <form method="post" action="{{ route('rekening.update', $rekening->id) }}" class="needs-validation" novalidate="">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{ $rekening->id }}">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2"></div>                               
                    <div class="form-group col-md-8 col-12">
                        <label>Nama Bank</label>
                        <input type="text" class="form-control @error('nama_bank') is-invalid @enderror" name="nama_bank" value="{{ $rekening->nama_bank }}">
                        @error('nama_bank')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="form-group col-md-8 col-12">
                        <label>Nama Pemilik</label>
                        <input type="text" class="form-control @error('nama_pemilik') is-invalid @enderror" name="nama_pemilik" value="{{ $rekening->nama_pemilik }}">
                        @error('nama_pemilik')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="form-group col-md-8 col-12">
                        <label>Nomor Rekening</label>
                        <input type="text" name="no_rekening" value="{{ $rekening->no_rekening }}" class="form-control @error('no_rekening') is-invalid @enderror" autocomplete="off">
                        @error('no_rekening')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
            <a href="{{ route('rekening.index') }}" class="btn btn-warning">Batal</a>
            <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
@endsection