@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Riwayat Pesanan</h4>
        </div>
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
        @elseif (session('fail'))
        <div class="card-body">
            <div class="alert alert-warning alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    {{ session('fail') }}
                </div>
            </div>
        </div>
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="table-1">
                    <thead>                                 
                        <tr>
                            <th class="text-center">No</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Jumlah Pembelian</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Status</th>
                            <th scope="col">Sisa Waktu</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataOrder as $no => $order)
                            <tr>
                                <th scope="row">{{ $no+1 }}</th>
                                <td>{{ $order->nama_produk }}</td>
                                @if ($order->nama_produk == "Telur")
                                <td>{{ $order->banyak_item }} Kg</td>
                                <td>Rp. {{ $order->nominal }}</td>
                                @else
                                <td>{{ $order->banyak_item }} Ekor</td>
                                <td>Rp. {{ $order->nominal }}</td>
                                @endif
                                <td>{{ $order->status_order }}</td>
                                @if ($order->status_order == 'Menunggu Pembayaran' or $order->status_order == 'Verifikasi Gagal')
                                <td><span id="clock"></span></td>
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
                                @else
                                <td class="text-center">-</td>
                                @endif
                                <td class="text-center">
                                    <a href="{{ route('produk.historyDetail.distributor', $order->id) }}" class="badge badge-info">Detail</a>
                                    @if ($order->bukti == null)
                                    <a href="#" data-id="{{ $order->id }}" class="badge badge-danger swal-confirm">
                                        <form action="{{ route('pesanan.destroy.distributor', $order->id) }}" id="delete{{ $order->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        </form>
                                        Batal
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page-scripts')
<script src="{{ asset('../assets/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('../assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('../assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('../assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('../assets/modules/sweetalert/sweetalert.min.js') }}"></script>
@endpush

@push('page-spesific-scripts')
<script src="{{ asset('../assets/js/page/modules-datatables.js') }}"></script>
<script>
    $(".swal-confirm").click(function(e) {
        id = e.target.dataset.id;
        swal({
            title: 'Yakin hapus data?',
            text: 'Data yang sudah dihapus tidak bisa dikembalikan!',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal('Poof! File anda berhasil dihapus!', {
                icon: 'success',
                });
                $(`#delete${id}`).submit();
            } else {
                // swal('Your imaginary file is safe!');
            }
        });
    });
</script>

@endpush