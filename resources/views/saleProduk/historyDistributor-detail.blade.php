@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Data Detail Pesanan</h4>
    </div>
    <div class="card-body">
        @foreach ($dataOrder as $order)
        @if ($order->bukti == null)
            <div class="alert alert-danger d-flex justify-content-between align-items-center" role="alert">
                <div>Segera lakukan pembayaran | Batas waktu 1 X 24 Jam | Berakhir dalam <span id="clock"></span></div>
                <div><a href="{{ route('produk.pembayaran.distributor', $order->id) }}" class="btn btn-warning">Bayar</a></div>
            </div>
        @endif
        <h5 class="card-title">Nama Produk : {{ $order->nama_produk }}</h5>
        <h5 class="card-title">Tanggal Pembelian : {{ Carbon\Carbon::parse($order->tanggal)->translatedFormat('l, d F Y') }}</h5>
        <h5 class="card-title">Nama Pembeli : {{ auth()->user()->name }}</h5>
        <h5 class="card-title">Alamat Pembeli : {{ auth()->user()->alamat }}</h5>
        <h5 class="card-title">Nomor HP Pembeli : {{ auth()->user()->noHp }}</h5>
        <h6 class="card-text">Jenis Pengiriman : {{ $order->jenis_pengiriman }}</h6>
        <h6 class="card-text">Total Harga : Rp. {{ $order->nominal }}</h5>
        @if ($order->nama_produk == 'Telur')
        <h6 class="card-text">Banyak Item : {{ $order->banyak_item }} Kg</h5>
        @else
        <h6 class="card-text">Banyak Item : {{ $order->banyak_item }} Ekor</h5>
        @endif
        
        {{-- <h6 class="card-text">Alamat : {{ $order->alamat }}</h6>
        <h6 class="card-text">Nomor HP : {{ $order->noHp }}</h6>
        <h6 class="card-text">Catatan : {{ $order->catatan }}</h6> --}}
        <h6 class="card-text">Status Pembayaran : {{ $order->status_order }}</h6>
        <a href="/distributor/rekapPemesanan" class="card-link">Kembali</a>
        @endforeach
    </div>
</div>
@endsection

@push('after-scripts')
    <script>
    // Set the date we're counting down to
    var countDownDate = new Date('{{ $order->batas_pembayaran }}').getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="demo"
    document.getElementById("clock").innerHTML = hours + " Jam "
    + minutes + " Menit " + seconds + " Detik ";

    // If the count down is finished, write some text
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("clock").innerHTML = "EXPIRED";
    }
    }, 1000);
    </script>
@endpush