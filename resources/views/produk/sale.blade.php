@extends('layouts.master')

@section('content')
    <div class="section-body">
        @if (session('warning'))
        <div class="card-body">
            <div class="alert alert-warning alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    {{ session('warning') }}
                </div>
            </div>
        </div>
        @endif
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Detail Pemesanan Produk {{ $produk->nama_produk }}</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('produk.purchase.distributor', $produk->id) }}" class="needs-validation" novalidate="">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="id_users" value="{{ auth()->user()->id }}">                               
                            <input type="hidden" name="id_produk" value="{{ $produk->id }}">
                            <input type="hidden" name="harga" value="{{ $produk->harga }}">
                            <div class="form-group col-md-6 col-12">
                                <label>Nama Produk</label>
                                <input type="text" class="form-control" value="{{ $produk->nama_produk }}" disabled>
                                <div class="invalid-feedback">
                                    Data tidak boleh kosong, harap diisi
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Alamat Mitra</label>
                                <input type="text" class="form-control" value="{{ $alamat_mitra }}" disabled>
                                <div class="invalid-feedback">
                                    Data tidak boleh kosong, harap diisi
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Harga</label>
                                <input type="text" class="form-control" value="{{ $produk->harga }}" disabled>
                                <div class="invalid-feedback">
                                    Data tidak boleh kosong, harap diisi
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Sisa Stok</label>
                                <input type="text" class="form-control" value="{{ $produk->jumlah_produk }}" disabled>
                                <div class="invalid-feedback">
                                    Data tidak boleh kosong, harap diisi
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Banyak Item</label>
                                <input type="number" min="1" step="1" class="form-control @error('banyak_item') is-invalid @enderror" name="banyak_item" placeholder="Dalam Kg">
                                @error('banyak_item')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Jenis Pengiriman</label>
                                <small>(Minimum pembelian 100 Kg untuk pengiriman)</small>
                                <select name="jenis_pengiriman" id="kandang" class="form-control @error('jenis_pengiriman') is-invalid @enderror">
                                    <option disabled selected>Pilih Salah Satu</option>
                                    <option value="Diambil ditempat">Diambil ditempat</option>
                                    <option value="Diantar">Diantar</option>
                                </select>
                                @error('jenis_pengiriman')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                    <a href="/distributor/produk/{{ $produk->id }}" class="btn btn-warning">Kembali</a>
                    <button type="submit" class="btn btn-primary">Selanjutnya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection