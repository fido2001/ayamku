@extends('layouts.master')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Panen</h4>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Data Panen
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
                    <th scope="col">Total Ternak</th>
                    <th scope="col">Lama Siklus</th>
                    <th scope="col">Tanggal Panen</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($panen as $no => $pan)
                    <tr>
                        <th scope="row">{{ $no+1 }}</th>
                        <td>{{ $pan->total_ternak }} Ekor</td>
                        {{-- <td>{{ $pan->lama_panen }} hari</td> --}}
                        <td>{{ date('d M Y', strtotime($pan->tanggal)) }}</td>
                        <td class="text-center">
                            <a href="{{ route('panen.edit', $pan->id) }}" class="badge badge-info btn-edit">Edit</a>
                            <a href="#" data-id="{{ $pan->id }}" class="badge badge-danger swal-confirm">
                                <form action="{{ route('panen.destroy', $pan->id) }}" id="delete{{ $pan->id }}" method="POST">
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
                        <h5 class="modal-title">Tambah Data Panen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('panen.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        
                                        <label for="progress">Data Progress</label>
                                        <select name="id_progress" id="progress" class="form-control @error('id_progress') is-invalid @enderror">
                                            <option disabled selected>Pilih Salah Satu</option>
                                            @foreach ($progress as $prg)
                                            @if (Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d') == $prg->tgl_selesai)
                                            <option value="{{ $prg->id }}">Kode Kandang : {{ $prg->kode }} | Sisa Ternak : {{ $prg->sisa_ternak }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('id_progress')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="kategori">Kategori</label>
                                        <select name="id_kategori" id="kategori" class="form-control @error('id_kategori') is-invalid @enderror">
                                            <option disabled selected>Pilih Salah Satu</option>
                                            @foreach ($dataKategori as $kategori)
                                                <option value="{{ $kategori->id }}">{{ $kategori->bobot }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_kategori')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="lama_panen">
                                            Lama Siklus
                                        </label>
                                        <input type="number" id="lama_panen" name="lama_panen" value="{{ old('lama_panen') }}" class="form-control @error('lama_panen') is-invalid @enderror" autocomplete="off">
                                        @error('lama_panen')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="total_ternak">
                                            Total Ternak
                                        </label>
                                        <input type="number" id="total_ternak" name="total_ternak" value="{{ old('total_ternak') }}" class="form-control @error('total_ternak') is-invalid @enderror" autocomplete="off">
                                        @error('total_ternak')
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