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
                        <input type="text" class="form-control @error('kode') is-invalid @enderror" name="kode" value="{{ $kandang->kode }}">
                        @error('kode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
                        <label>
                            Rekomendasi Jumlah Ternak
                        </label>
                        <input id="rekom" class="form-control" disabled>
                    </div>
                </div>
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label>Jumlah Ternak</label>
                        <input type="number" min="1" step="1" class="form-control @error('jumlahBibit') is-invalid @enderror" name="jumlahBibit" value="{{ $kandang->jumlahBibit }}">
                        @error('jumlahBibit')
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

@push('after-scripts')
<script>
    $(".input").on('input', function(){
        
        var x = document.getElementById('panjang').value;
        x = parseFloat(x);
        
        var y = document.getElementById('lebar').value;
        y = parseFloat(y);

        if(Number.isNaN(x))
        x=0;
        else if(Number.isNaN(y))
        y=0;
        document.getElementById('rekom').value = (x*y)*8;
    });
</script>
@endpush