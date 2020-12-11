@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('../assets/modules/chocolat/dist/css/chocolat.css') }}">
@endsection

@section('content')
<div class="card">
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
        {{-- <a href="" class="badge badge-info">Verifikasi Pembayaran</a> --}}
        {{-- <a class="badge badge-info mb-3" href="{{ route('verifikasi.pembayaran.admin', $order->id) }}"
            onclick="event.preventDefault();
                document.getElementById('verifikasi-form').submit();">
            Verifikasi Berhasil
        </a>

        <form id="verifikasi-form" action="{{ route('verifikasi.pembayaran.admin', $order->id) }}" method="POST" class="d-none">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="dikemas">
        </form> --}}
        @endif
        @endforeach
        {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
        <br><a href="/admin/rekapPemesanan" class="card-link">Kembali</a>
    </div>
</div>
@endsection

@push('page-scripts')
<script src="{{ asset('../assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
@endpush