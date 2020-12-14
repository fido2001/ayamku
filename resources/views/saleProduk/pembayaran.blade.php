@extends('layouts.master')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="invoice">
            @foreach ($dataOrder as $order)
            <div class="invoice-print">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-title">
                            <h2>Invoice</h2>
                            {{-- <div class="invoice-number">Order #12345</div> --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">Detail Pemesanan</div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-md">
                                <tr>
                                    <th data-width="40">#</th>
                                    <th>Item</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Banyak Item</th>
                                    <th class="text-right">Total</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>{{ $order->nama_produk }}</td>
                                    <td class="text-center">Rp. {{ $order->harga }}</td>
                                    <td class="text-center">{{ $order->banyak_item }} Pcs</td>
                                    <td class="text-right">Rp. {{ $order->harga*$order->banyak_item }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-8">
                                <div class="section-title">Bank Tujuan Pembayaran</div>
                                @foreach ($dataRekening as $rekening)
                                <div class="row no-gutters justify-content-center align-items-center pb-2">
                                    {{-- <img class="img-fluid" src="{{ asset('assets/img/mandiri.png') }}" style="height: 40px" alt="visa"> --}}
                                    <h5 class="mr-3" style="color: black">Bank {{ $rekening->nama_bank }}</h5>
                                    <h5 class="mb-0">{{ $rekening->no_rekening }}</h5>
                                    <div class="col-4"></div>
                                    <div class="col-8 mt-2"><h6>a.n. {{ $rekening->nama_pemilik }}</h6></div>
                                    <div class="col-8 border-bottom mt-2"></div>
                                    <div class="col-4"></div>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-lg-4 text-right">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Subtotal</div>
                                    <div class="invoice-detail-value">Rp. {{ $order->harga*$order->banyak_item }}</div>
                                </div>
                                @if ($order->jenis_pengiriman == 'Diantar')
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Biaya Antar</div>
                                    <div class="invoice-detail-value">Rp. {{ $order->banyak_item * 1000 }}</div>
                                </div>
                                @endif
                            <hr class="mt-2 mb-2">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Total</div>
                                    <div class="invoice-detail-value invoice-detail-value-lg"><h1>Rp. {{ $order->nominal }}</h1></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('produk.pembayaran.distributor', $order->id) }}" class="needs-validation" enctype="multipart/form-data" novalidate="">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <input type="hidden" name="nominal" value="{{ $order->nominal }}">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Atas Nama</label>
                                <input type="text" name="atas_nama" class="form-control summernote-simple @error('atas_nama') is-invalid @enderror">
                                @error('atas_nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Nomor Rekening</label>
                                <input type="text" name="rekening" class="form-control summernote-simple @error('rekening') is-invalid @enderror">
                                @error('rekening')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label for="exampleFormControlFile1">Bukti Pembayaran</label>
                                <input type="file" name="bukti" class="form-control-file @error('bukti') is-invalid @enderror" id="exampleFormControlFile1">
                                @error('bukti')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-md-right">
                        <div class="float-lg-left mb-lg-0 mb-3">
                            <button type="submit" class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Kirim</button>
                            <a href="/distributor/rekapPemesanan/{{ $order->id }}" class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Batal</a>
                        </div>
                    </div>
                </form>
            </div>
            <hr>
            @endforeach
        </div>
    </div>
</div>
@endsection