@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header"><h4>Edit Data Progress</h4></div>
        <form method="post" action="{{ route('progress.update', $progress) }}" class="needs-validation" novalidate="">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{ $progress->id }}">
            <input type="hidden" name="id_kandang" value="{{ $progress->id_kandang }}">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2"></div>                               
                    <div class="form-group col-md-8 col-12">
                        <label>Kode Kandang</label>
                        <input type="text" class="form-control" name="" value="{{ $progress->kandang->kode }}" required="" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="form-group col-md-8 col-12">
                        <label>Tanggal Progress</label>
                        <input type="text" class="form-control" name="" value="{{ date('d M Y', strtotime($progress->ket_waktu)) }}" required="" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="form-group col-md-8 col-12">
                        <label>Sisa ternak</label>
                        <input type="text" class="form-control @error('sisa_ternak') is-invalid @enderror" name="sisa_ternak" value="{{ $progress->sisa_ternak }}" required="">
                        @error('sisa_ternak')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="form-group col-md-8 col-12">
                        <label>Perkembangan</label>
                        <textarea type="text" class="form-control @error('perkembangan') is-invalid @enderror" name="perkembangan">{{ $progress->perkembangan }}</textarea>
                        @error('perkembangan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="form-group col-md-8 col-12">
                        <label>Keluhan</label><small>( Tidak perlu diisi jika tidak ada keluhan. )</small>
                        <textarea type="text" class="form-control @error('keluhan') is-invalid @enderror" name="keluhan">{{ $progress->keluhan }}</textarea>
                        @error('keluhan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
            <a href="{{ route('progress.index') }}" class="btn btn-warning">Batal</a>
            <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
@endsection