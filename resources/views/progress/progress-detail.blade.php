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
            @if ($dtProgress->kategori == 'Produksi')
            <h6>Kategori : {{ $dtProgress->kategori }}</h6>
            <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                    <thead>                                 
                        <tr>
                            <th class="text-center">No</th>
                            <th scope="col">Sisa Ternak</th>
                            <th scope="col">Ternak Mati</th>
                            <th scope="col">Banyak Telur</th>
                            <th scope="col">Jumlah Pakan</th>
                            <th scope="col">Tanggal Progress</th>
                            <th scope="col">Ket Waktu</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($progressDetail as $no => $progress)
                        <tr>
                            <th scope="row">{{ $no+1 }}</th>
                            <td>{{ $progress->jumlah_ternak }} Ekor</td>
                            <td>{{ $progress->ternak_mati }} Ekor</td>
                            <td>{{ $progress->banyak_telur }} Butir</td>
                            <td>{{ $progress->jumlah_pakan }} Kg</td>
                            <td>{{ $progress->getTanggalProgress() }}</td>
                            <td>{{ $progress->ket_waktu }}</td>
                            <td class="text-center">
                                <a href="{{ route('progress.edit', $progress->id) }}" class="badge badge-info">Edit</a>
                                {{-- <a href="{{ route('progress-detail.index', $progress->id) }}" class="badge badge-success">Detail</a> --}}
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
            @else
            <h6>Kategori : {{ $dtProgress->kategori }} / Pembesaran</h6>
            <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                    <thead>                                 
                        <tr>
                            <th class="text-center">No</th>
                            <th scope="col">Sisa Ternak</th>
                            <th scope="col">Ternak Mati</th>
                            <th scope="col">Jumlah Pakan</th>
                            <th scope="col">Tanggal Progress</th>
                            <th scope="col">Ket Waktu</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($progressDetail as $no => $progress)
                        <tr>
                            <th scope="row">{{ $no+1 }}</th>
                            <td>{{ $progress->jumlah_ternak }} Ekor</td>
                            <td>{{ $progress->ternak_mati }} Ekor</td>
                            <td>{{ $progress->jumlah_pakan }} Kg</td>
                            <td>{{ $progress->getTanggalProgress() }}</td>
                            <td>{{ $progress->ket_waktu }}</td>
                            <td class="text-center">
                                <a href="{{ route('progress.edit', $progress->id) }}" class="badge badge-info">Edit</a>
                                {{-- <a href="{{ route('progress-detail.index', $progress->id) }}" class="badge badge-success">Detail</a> --}}
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
            @endif
            @endforeach
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
                    <form action="{{ route('progress-detail.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" value="{{ $dtProgress->id }}" name="id_progress">
                                @if ($dtProgress->kategori == 'Produksi')
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="lebar">
                                            Banyak Telur 
                                        </label>
                                        <input type="number" min="1" step="1" id="banyak_telur" name="banyak_telur" value="{{ old('banyak_telur') }}" class="form-control @error('banyak_telur') is-invalid @enderror" autocomplete="off">
                                        @error('banyak_telur')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="lebar">
                                            Sisa Ternak
                                        </label>
                                        <input type="number" min="1" step="1" id="jumlah_ternak" name="jumlah_ternak" value="{{ old('jumlah_ternak') }}" class="form-control @error('jumlah_ternak') is-invalid @enderror" autocomplete="off">
                                        @error('jumlah_ternak')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="lebar">
                                            Ternak Mati
                                        </label>
                                        <input type="number" min="1" step="1" id="ternak_mati" name="ternak_mati" value="{{ old('ternak_mati') }}" class="form-control @error('ternak_mati') is-invalid @enderror" autocomplete="off">
                                        @error('ternak_mati')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="vitamin">Vitamin</label>
                                        <select name="id_vitamin" id="vitamin" class="form-control @error('id_vitamin') is-invalid @enderror">
                                            <option disabled selected>Pilih Salah Satu</option>
                                            @foreach ($dataVitamin as $vitamin)
                                                <option value="{{ $vitamin->id }}">Nama Vitamin : {{ $vitamin->jenis_vitamin }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_vitamin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="kategori">Jenis Puyuh</label>
                                        <select name="id_kategori" id="kategori" class="form-control @error('id_kategori') is-invalid @enderror">
                                            <option disabled selected>Pilih Salah Satu</option>
                                            @foreach ($dataKategori as $kategori)
                                                <option value="{{ $kategori->id }}">Jenis Puyuh : {{ $kategori->jenis_ternak }}</option>
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
                                        <label for="lebar">
                                            Jumlah Pakan
                                        </label>
                                        <input type="number" placeholder="Dalam Kilogram" min="1" step="1" id="jumlah_pakan" name="jumlah_pakan" value="{{ old('jumlah_pakan') }}" class="form-control @error('jumlah_pakan') is-invalid @enderror" autocomplete="off">
                                        @error('jumlah_pakan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="ket_waktu">Jadwal</label>
                                        <select name="ket_waktu" class="form-control" id="ket_waktu">
                                            <option value="Pagi">Pagi</option>
                                            <option value="Sore">Sore</option>              
                                        </select>
                                        @error('ket_waktu')
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