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
            <h4>Data Produk</h4>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Produk
            </button>
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
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                    <thead>                                 
                        <tr>
                            <th class="text-center">No</th>
                            <th scope="col">Harga Produk</th>
                            <th scope="col">Jumlah Produk</th>
                            <th scope="col">Tanggal Produk</th>
                            <th scope="col">Kategori</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataProduk as $no => $produk)
                            <tr>
                                <th scope="row">{{ $no+1 }}</th>
                                @if ($produk->nama_produk == "Telur")
                                <td>Rp. {{ $produk->harga }}/Kg</td>
                                <td>{{ $produk->jumlah_produk }} Kg</td>
                                @else
                                <td>Rp. {{ $produk->harga }}/Ekor</td>
                                <td>{{ $produk->jumlah_produk }} Ekor</td>
                                @endif
                                <td>{{ Carbon\Carbon::parse($produk->tgl_produk)->translatedFormat('l, d F Y') }}</td>
                                <td>{{ $produk->nama_produk }}</td>
                                <td class="text-center">
                                    <a href="{{ route('produk.edit', $produk->id) }}" class="badge badge-info btn-edit">Ubah</a>
                                    <a href="#" data-id="{{ $produk->id }}" class="badge badge-danger swal-confirm">
                                        <form action="{{ route('produk.destroy', $produk->id) }}" id="delete{{ $produk->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        </form>
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    @section('modal')
        <!-- Modal Tambah Data Progress-->
        <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="progress">Data Panen Parsial</label>
                                        <select name="id_progress_detail" id="progress" class="form-control @error('id_progress_detail') is-invalid @enderror">
                                            <option disabled selected>Pilih Salah Satu</option>
                                            @foreach ($dataProgress as $progress)
                                            @if ($progress->banyak_telur != null)
                                            <option value="{{ $progress->id }}">Tanggal Progress : {{ Carbon\Carbon::parse($progress->tgl_progress)->translatedFormat('l, d F Y') }} | Banyak Telur : {{ $progress->banyak_telur }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('id_progress_detail')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="panen">Jumlah Produk <small>(Dalam Kg)</small></label>
                                        <input type="number" min="1" step="1" name="jumlah_produk" id="panen" class="form-control @error('jumlah_produk') is-invalid @enderror">
                                        @error('jumlah_produk')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="total_ternak">
                                            Harga
                                        </label>
                                        <input type="number" min="1" step="1" id="harga" name="harga" value="{{ old('harga') }}" class="form-control @error('harga') is-invalid @enderror" autocomplete="off">
                                        @error('harga')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nama_produk">Kategori Produk</label>
                                        <select name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" id="nama_produk">
                                            <option value="Telur">Telur</option>
                                            <option value="Avkir">Avkir</option>              
                                        </select>
                                        @error('nama_produk')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="gambar">Gambar Produk</label>
                                        <input type="file" name="gambar" class="form-control-file @error('gambar') is-invalid @enderror" id="exampleFormControlFile1">
                                        @error('gambar')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
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