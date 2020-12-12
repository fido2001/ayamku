@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('../assets/modules/chocolat/dist/css/chocolat.css') }}">
@endsection

@section('content')
<div class="card">
    @if (session('success'))
        <div class="card-body">
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif
    <div class="card-body">
        @foreach ($dataOrder as $order)
            <h5 class="card-title">Detail Pemesanan {{ $order->nama_produk }}</h5>
            <h6 class="card-text">Total Harga : {{ $order->nominal }}</h5>
            <h6 class="card-text">Atas Nama : {{ $order->atas_nama }}</h6>
            <h6 class="card-text">Alamat Distributor : {{ $order->alamat }}</h6>
            @if ($order->nama_produk == 'Telur')
            <h6 class="card-text">Jumlah Pemesanan : {{ $order->banyak_item }} Kg</h5>
            @else
            <h6 class="card-text">Jumlah Pemesanan : {{ $order->banyak_item }} Ekor</h5>
            @endif
            @if ($order->bukti != null && $order->status_order == 'Verifikasi Berhasil')
            <h6 class="card-text">Bukti Pembayaran : </h6>
            <div class="gallery">
                <div class="gallery-item" data-image="{{ $order->takeImage() }}"></div>
            </div>
            @elseif ($order->bukti != null && $order->status_order == 'Belum Terverifikasi')
            <h6 class="card-text">Bukti Pembayaran : </h6>
            <div class="gallery">
                <div class="gallery-item" data-image="{{ $order->takeImage() }}"></div>
            </div><br>
            <a href="" class="badge badge-success" data-toggle="modal" data-target="#exampleModalBerhasil">
                Verifikasi Berhasil
            </a>
            <a href="" class="badge badge-danger" data-toggle="modal" data-target="#exampleModalGagal">
                Verifikasi Gagal
            </a>
            @endif
        @endforeach
        <br><br><a href="/admin/rekapPemesanan" class="card-link">Kembali</a>
    </div>
</div>
    @section('modal')
    <div class="modal fade" id="exampleModalBerhasil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin Verifikasi Berhasil pesanan ini?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="verifikasi-form" action="{{ route('verifikasi.berhasil', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="d-flex">
                            <input type="hidden" name="status_order" value="Verifikasi Berhasil">
                            <button class="btn btn-success mr-3" type="submit">Ya</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalGagal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin Verifikasi Gagal pesanan ini?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="verifikasi-form" action="{{ route('verifikasi.gagal', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="d-flex">
                            <input type="hidden" name="status_order" value="Verifikasi Gagal">
                            <button class="btn btn-danger mr-3" type="submit">Ya</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
@endsection

@push('page-scripts')
<script src="{{ asset('../assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
@endpush