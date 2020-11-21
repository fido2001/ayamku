@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header"><h4>Edit Data Panen</h4></div>
        <form method="post" action="{{ route('panen.update', $panen) }}" class="needs-validation" novalidate="">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{ $panen->id }}">
            <input type="hidden" name="id_progress" value="{{ $panen->id_progress }}">
            <input type="hidden" name="tanggal" value="{{ $panen->tanggal }}">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="form-group col-md-8 col-12">
                        <label>Tanggal Progress</label>
                        <input type="text" class="form-control" name="" value="{{ date('d M Y', strtotime($panen->progress->ket_waktu)) }}" required="" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="form-group col-md-8 col-12">
                        <label>Sisa Ternak pada Data Progress</label>
                        <input type="text" class="form-control" name="" value="{{ $panen->progress->sisa_ternak }}" required="" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="form-group col-md-8 col-12">
                        <label for="kategori">Kategori</label>
                        <select name="id_kategori" id="kategori" class="form-control @error('id_kategori') is-invalid @enderror">
                            <option disabled selected>Pilih Salah Satu</option>
                            @foreach ($dataKategori as $kategori)
                                <option {{ $kategori->id == $panen->id_kategori ? 'selected' : '' }} value="{{ $kategori->id }}">{{ $kategori->bobot }}</option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="form-group col-md-8 col-12">
                        <label>Total Ternak</label>
                        <input type="number" class="form-control @error('total_ternak') is-invalid @enderror" name="total_ternak" value="{{ $panen->total_ternak }}" required="">
                        @error('total_ternak')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="form-group col-md-8 col-12">
                        <label>Lama Siklus</label>
                        <input type="number" class="form-control @error('lama_panen') is-invalid @enderror" name="lama_panen" value="{{ $panen->lama_panen }}" required="">
                        @error('lama_panen')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
            </div>
            <div class="card-footer text-right">
            <a href="{{ route('panen.index') }}" class="btn btn-warning">Batal</a>
            <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
@endsection