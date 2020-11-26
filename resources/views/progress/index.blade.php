@extends('layouts.master')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Progress</h4>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Data Progress
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
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kode Kandang</th>
                    <th scope="col">Sisa Ternak</th>
                    <th scope="col">Lama Siklus</th>
                    <th scope="col">Tanggal Mulai</th>
                    <th scope="col">Tanggal Selesai</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($dataProgress as $no => $progress)
                    <tr>
                        <th scope="row">{{ $no+1 }}</th>
                        <td>{{ $progress->kode }}</td>
                        <td>{{ $progress->sisa_ternak }} Ekor</td>
                        <td>{{ $progress->lama_siklus }}</td>
                        <td>{{ $progress->getTanggalMulai() }}</td>
                        <td>{{ $progress->getTanggalSelesai() }}</td>
                        <td class="text-center">
                            <a href="{{ route('progress.edit', $progress->id) }}" class="badge badge-info btn-edit">Edit</a>
                            <a href="#" data-id="{{ $progress->id }}" class="badge badge-danger swal-confirm">
                                <form action="{{ route('progress.destroy', $progress->id) }}" id="delete{{ $progress->id }}" method="POST">
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
    @section('modal')
        <!-- Modal Tambah Data Progress-->
        <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Progress</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('progress.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="kandang">Kandang</label>
                                        <select name="id_kandang" id="kandang" class="form-control @error('id_kandang') is-invalid @enderror">
                                            <option disabled selected>Pilih Salah Satu</option>
                                            @foreach ($dataKandang as $kandang)
                                                <option value="{{ $kandang->id }}">{{ $kandang->kode }} , Jumlah Bibit : {{ $kandang->jumlahBibit }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_kandang')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="lebar">
                                            Sisa Ternak
                                        </label>
                                        <input type="number" min="1" step="1" id="sisa_ternak" name="sisa_ternak" value="{{ old('sisa_ternak') }}" class="form-control @error('sisa_ternak') is-invalid @enderror" autocomplete="off">
                                        @error('sisa_ternak')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="lebar">
                                            Lama Siklus (Hari)
                                        </label>
                                        <input type="number" min="1" step="1" id="lama_siklus" name="lama_siklus" value="{{ old('lama_siklus') }}" class="form-control @error('lama_siklus') is-invalid @enderror" autocomplete="off">
                                        @error('lama_siklus')
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
@endpush