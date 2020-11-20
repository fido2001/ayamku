@extends('layouts.master')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Vitamin</h4>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Data Vitamin
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
                    <th scope="col">Jenis Vitamin</th>
                    <th scope="col">Takaran</th>
                    <th scope="col">Syarat</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($dataVitamin as $no => $vitamin)
                    <tr>
                        <th scope="row">{{ $no+1 }}</th>
                        <td>{{ $vitamin->jenis_vitamin }}</td>
                        <td>{{ $vitamin->takaran }}</td>
                        <td>{{ $vitamin->syarat }}</td>
                        <td class="text-center">
                            <a href="{{ route('vitamin.edit', $vitamin->id) }}" class="badge badge-info btn-edit">Edit</a>
                            <a href="#" data-id="{{ $vitamin->id }}" class="badge badge-danger swal-confirm">
                                <form action="{{ route('vitamin.destroy', $vitamin->id) }}" id="delete{{ $vitamin->id }}" method="POST">
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
        <!-- Modal Tambah Data Vitamin-->
        <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Vitamin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('vitamin.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Jenis Vitamin
                                        </label>
                                        <input type="text" name="jenis_vitamin" value="{{ old('jenis_vitamin') }}" class="form-control @error('jenis_vitamin') is-invalid @enderror" autocomplete="off">
                                        @error('jenis_vitamin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Takaran
                                        </label>
                                        <input type="text" name="takaran" value="{{ old('takaran') }}" class="form-control @error('takaran') is-invalid @enderror" autocomplete="off">
                                        @error('takaran')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Syarat
                                        </label>
                                        <input type="text" name="syarat" value="{{ old('syarat') }}" class="form-control @error('syarat') is-invalid @enderror" autocomplete="off">
                                        @error('syarat')
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