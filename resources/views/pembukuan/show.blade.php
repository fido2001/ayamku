@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header"><h4>Edit Data Pembukuan</h4></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2"></div>                               
                <div class="form-group col-md-8 col-12">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" value="{{ $pembukuan->nama }}" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="form-group col-md-8 col-12">
                    <label>Tanggal</label>
                    <input type="text" class="form-control" name="tanggal" value="{{ Carbon\Carbon::parse($pembukuan->tanggal)->translatedFormat('l, d F Y') }}" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="form-group col-md-8 col-12">
                    <label>Nominal</label>
                    @if ($pembukuan->debit == null)
                    <input type="text"class="form-control" name="nominal" value="{{ $pembukuan->kredit }}" disabled>
                    @else
                    <input type="text"class="form-control" name="nominal" value="{{ $pembukuan->debit }}" disabled>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="form-group col-md-8 col-12">
                    <label>Jenis Kas</label>
                    <input type="text" class="form-control" value="{{ $pembukuan->jenis }}" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="form-group col-md-8 col-12">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan" id="keterangan" rows="3" disabled>{{ $pembukuan->keterangan }}</textarea>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
        <a href="{{ route('pembukuan.index') }}" class="btn btn-warning">Kembali</a>
        </div>
    </div>
@endsection