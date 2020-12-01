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
        <div class="card-body">
            @foreach ($dataProgress as $dtProgress)
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            @endforeach
            <a href="{{ route('progress.index.admin') }}">Kembali</a>
        </div>
    </div>
</div>
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