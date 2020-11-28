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
            <h3>Data Detail Progress</h3>
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
            @foreach ($dataProgress as $dtProgress)
            @if (Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d') <= $dtProgress->tgl_selesai)
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                Tambah Progress
            </button>
            @endif
            <h6>Lama Siklus : {{ $dtProgress->lama_siklus }} Hari</h6>
            <h6>Tanggal Mulai : {{ $dtProgress->getTanggalMulai() }}</h6>
            <h6>Tanggal Selesai : {{ $dtProgress->getTanggalSelesai() }}</h6>
            <h6>Sisa Ternak Sementara : {{ $dtProgress->sisa_ternak }} Ekor</h6>
            @endforeach
            <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                    <thead>                                 
                        <tr>
                            <th class="text-center">No</th>
                            <th scope="col">Ternak Sehat</th>
                            <th scope="col">Ternak Sakit</th>
                            <th scope="col">Tanggal Progress</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($progressDetail as $no => $progress)
                        <tr>
                            <th scope="row">{{ $no+1 }}</th>
                            <td>{{ $progress->ternak_sehat }} Ekor</td>
                            <td>{{ $progress->ternak_sakit }} Ekor</td>
                            <td>{{ $progress->getTanggalProgress() }}</td>
                            <td class="text-center">
                                {{-- <a href="{{ route('progress.edit', $progress->id) }}" class="badge badge-info">Edit</a>
                                <a href="{{ route('progress-detail.index', $progress->id) }}" class="badge badge-success">Detail</a> --}}
                                {{-- <a href="#" data-id="{{ $progress->id }}" class="badge badge-danger swal-confirm">
                                    <form action="{{ route('progress.destroy', $progress->id) }}" id="delete{{ $progress->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    </form>
                                    Hapus
                                </a> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('progress.index') }}">Kembali</a>
        </div>
    </div>
</div>
    @section('modal')
        <!-- Modal Tambah Data Progress-->
        <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Progress</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @foreach ($dataProgress as $dtProgress)
                    <form action="{{ route('progress-detail.store', $dtProgress->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" value="{{ $dtProgress->id }}" name="id_progress">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="lebar">
                                            Ternak Sehat
                                        </label>
                                        <input type="number" min="1" step="1" id="ternak_sehat" name="ternak_sehat" value="{{ old('ternak_sehat') }}" class="form-control @error('ternak_sehat') is-invalid @enderror" autocomplete="off">
                                        @error('ternak_sehat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="lebar">
                                            Ternak Sakit
                                        </label>
                                        <input type="number" min="1" step="1" id="ternak_sakit" name="ternak_sakit" value="{{ old('ternak_sakit') }}" class="form-control @error('ternak_sakit') is-invalid @enderror" autocomplete="off">
                                        @error('ternak_sakit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Perkembangan
                                        </label>
                                        <textarea name="perkembangan" id="perkembangan" class="form-control @error('perkembangan') is-invalid @enderror">{{ old('perkembangan') }}</textarea>
                                        @error('perkembangan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Keluhan</label>
                                        <small class="text-muted">( Tidak perlu diisi jika tidak ada keluhan. )</small>
                                        <textarea name="keluhan" id="keluhan" class="form-control @error('keluhan') is-invalid @enderror">{{ old('keluhan') }}</textarea>
                                        @error('keluhan')
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
                    @endforeach
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
@endpush

@push('page-spesific-scripts')
<script src="{{ asset('../assets/js/page/modules-datatables.js') }}"></script>
@endpush

{{-- @push('page-scripts')
<script src="{{ asset('../assets/modules/sweetalert/sweetalert.min.js') }}"></script>
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
@endpush --}}