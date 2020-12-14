@extends('layouts.master')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Detail Produk {{ $produk->nama_produk }}</h4>
        </div>
        <div class="card-body">
            <img style="height: 350px; object-fit: cover; object-position: center" class="rounded" src="{{ $produk->takeImage() }}">
            <h5>Harga : Rp. {{ $produk->harga }}</h5>
            <h5>Stok : {{ $produk->jumlah_produk }} Kg</h5>
            <h5>Alamat Toko : {{ $alamat_mitra }}</h5>
            <a href="/distributor/produk">Kembali</a>
            <a href="{{ route('produk.sale.distributor', $produk->id) }}" class="badge badge-info btn-edit float-right">Beli</a>
        </div>
    </div>
</div>
@endsection