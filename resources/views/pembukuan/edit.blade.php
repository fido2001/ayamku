@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header"><h4>Edit Data Pembukuan</h4></div>
        <form method="post" action="{{ route('pembukuan.update', $pembukuan->id) }}" class="needs-validation" novalidate="">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2"></div>                               
                    <div class="form-group col-md-8 col-12">
                        <label>Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $pembukuan->nama }}">
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-md-2"></div>
                    <div class="form-group col-md-8 col-12">
                        <label>Tanggal</label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal">
                        @error('tanggal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="form-group col-md-8 col-12">
                        <label>Nominal</label>
                        @if ($pembukuan->debit == null)
                        <input type="number" min="1000" step="100" class="form-control @error('nominal') is-invalid @enderror" name="nominal" value="{{ $pembukuan->kredit }}">
                        @else
                        <input type="number" min="1000" step="100" class="form-control @error('nominal') is-invalid @enderror" name="nominal" value="{{ $pembukuan->debit }}">
                        @endif
                        @error('nominal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="form-group col-md-8 col-12">
                        <label>Jenis Kas</label>
                        <select name="jenis" id="" class="form-control @error('jenis') is-invalid @enderror">
                            <option disabled selected>Pilih Salah Satu</option>
                            <option value="Pemasukan">Pemasukan</option>
                            <option value="Pengeluaran">Pengeluaran</option>
                        </select>
                        @error('jenis')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="form-group col-md-8 col-12">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" rows="3">{{ $pembukuan->keterangan }}</textarea>
                        @error('keterangan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
            <a href="{{ route('pembukuan.index') }}" class="btn btn-warning">Batal</a>
            <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
@endsection