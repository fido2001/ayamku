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
            <h4>Data Progress</h4>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                + Tambah
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
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Debit</th>
                            <th scope="col">Kredit</th>
                            <th scope="col">Jenis Kas</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataPembukuan as $no => $pembukuan)
                            <tr>
                                <th scope="row">{{ $no+1 }}</th>
                                <td><a href="{{ route('pembukuan.show', $pembukuan->id) }}">{{ $pembukuan->nama }}</a></td>
                                <td>{{ Carbon\Carbon::parse($pembukuan->tanggal)->translatedFormat('l, d F Y') }}</td>
                                @if ($pembukuan->debit != null and $pembukuan->kredit == null)
                                <td>Rp. {{ $pembukuan->debit }}</td>
                                <td>-</td>
                                @else
                                <td>-</td>
                                <td>Rp. {{ $pembukuan->kredit }}</td>
                                @endif
                                <td>{{ $pembukuan->jenis }}</td>
                                <td class="text-center">
                                    <a href="{{ route('pembukuan.edit', $pembukuan->id) }}" class="badge badge-success">Ubah</a>
                                    <a href="#" data-id="{{ $pembukuan->id }}" class="badge badge-danger swal-confirm">
                                        <form action="{{ route('pembukuan.destroy', $pembukuan->id) }}" id="delete{{ $pembukuan->id }}" method="POST">
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
            <div class="row">
                Pemasukan = Rp. {{ $pemasukan }} | Pengeluaran = Rp. {{ $pengeluaran }} | Total Keuntungan = Rp. {{ $pemasukan-$pengeluaran }}
            </div>
        </div>
    </div>
</div>
    @section('modal')
    <!-- Modal Tambah Data Vitamin-->
    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Pembukuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pembukuan.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        Nama
                                    </label>
                                    <input type="text" name="nama" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" autocomplete="off">
                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        Tanggal
                                    </label>
                                    <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="form-control @error('tanggal') is-invalid @enderror" autocomplete="off">
                                    @error('tanggal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        Nominal
                                    </label>
                                    <input type="number" min="1000" step="100" name="nominal" value="{{ old('nominal') }}" class="form-control @error('nominal') is-invalid @enderror" autocomplete="off">
                                    @error('nominal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        Jenis Kas
                                    </label>
                                    <select name="jenis" id="" class="form-control @error('jenis') is-invalid @enderror">
                                        <option disabled selected>Pilih Salah Satu</option>
                                        <option value="Pemasukan">Pemasukan</option>
                                        <option value="Pengeluaran">Pengeluaran</option>
                                    </select>
                                    @error('jenis')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="font-weight-bold" for="keterangan">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
                                    @error('keterangan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
@endsection

@push('page-scripts')
<script src="{{ asset('../assets/modules/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('../assets/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('../assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('../assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('../assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
@endpush

@push('page-spesific-scripts')
<script src="{{ asset('../assets/js/page/modules-datatables.js') }}"></script>
@endpush

@push('after-scripts')
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