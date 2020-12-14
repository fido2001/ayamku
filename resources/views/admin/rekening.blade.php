@extends('layouts.master')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Rekening</h4>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Data Rekening
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
                    <th scope="col">Nama Bank</th>
                    <th scope="col">Nama Pemilik</th>
                    <th scope="col">Nomor Rekening</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($dataRekening as $no => $rekening)
                    <tr>
                        <th scope="row">{{ $no+1 }}</th>
                        <td>{{ $rekening->nama_bank }}</td>
                        <td>{{ $rekening->nama_pemilik }}</td>
                        <td>{{ $rekening->no_rekening }}</td>
                        <td class="text-center">
                            <a href="{{ route('rekening.edit', $rekening->id) }}" class="badge badge-info btn-edit">Edit</a>
                            <a href="#" data-id="{{ $rekening->id }}" class="badge badge-danger swal-confirm">
                                <form action="{{ route('rekening.destroy', $rekening->id) }}" id="delete{{ $rekening->id }}" method="POST">
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
        <!-- Modal Tambah Data Rekening-->
        <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Rekening</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('rekening.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Bank</label>
                                        <input type="text" name="nama_bank" value="{{ old('nama_bank') }}" class="form-control @error('nama_bank') is-invalid @enderror" autocomplete="off">
                                        @error('nama_bank')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Pemilik</label>
                                        <input type="text" name="nama_pemilik" value="{{ old('nama_pemilik') }}" class="form-control @error('nama_pemilik') is-invalid @enderror" autocomplete="off">
                                        @error('nama_pemilik')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nomor Rekening</label>
                                        <input type="text" name="no_rekening" value="{{ old('no_rekening') }}" class="form-control @error('no_rekening') is-invalid @enderror" autocomplete="off">
                                        @error('no_rekening')
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