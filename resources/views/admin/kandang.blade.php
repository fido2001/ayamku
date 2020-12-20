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
            <h4>Data Kandang</h4>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Data Kandang
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
                            <th scope="col">Nama Kandang</th>
                            <th scope="col">Panjang</th>
                            <th scope="col">Lebar</th>
                            <th scope="col">Jenis Kandang</th>
                            <th scope="col">Jumlah Koloni</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kandang as $no => $kdg)                                
                        <tr>
                            <td class="text-center">
                                {{ $no+1 }}
                            </td>
                            <td>{{ $kdg->nama_kandang }}</td>
                            <td>{{ $kdg->panjang }} Meter</td>
                            <td>{{ $kdg->lebar }} Meter</td>
                            <td>{{ $kdg->jenis_kandang }}</td>
                            <td>{{ $kdg->jumlah_koloni }}</td>
                            <td class="text-center">
                                <a href="{{ route('kandang.edit', $kdg->id) }}" class="badge badge-info btn-edit">Ubah</a>
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
        <!-- Modal Tambah Data Kandang-->
        <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Kandang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('kandang.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Nama Kandang
                                        </label>
                                        <input type="text" name="nama_kandang" value="{{ old('nama_kandang') }}" class="form-control @error('nama_kandang') is-invalid @enderror" autocomplete="off">
                                        @error('nama_kandang')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="jenis_kandang">Jenis Kandang</label>
                                        <select name="jenis_kandang" class="form-control" id="jenis_kandang">
                                            <option value="Pembibitan">Pembibitan</option>
                                            <option value="Produksi">Produksi</option>              
                                        </select>
                                        @error('jenis_kandang')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="panjang">
                                            Panjang Kandang (dalam Meter)
                                        </label>
                                        <input type="number" min="1" step="1" id="panjang" name="panjang" value="{{ old('panjang') }}" class="input form-control @error('panjang') is-invalid @enderror" autocomplete="off">
                                        @error('panjang')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="lebar">
                                            Lebar Kandang (dalam Meter)
                                        </label>
                                        <input type="number" min="1" step="1" id="lebar" name="lebar" value="{{ old('lebar') }}" class="input form-control @error('lebar') is-invalid @enderror" autocomplete="off">
                                        @error('lebar')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Jumlah Koloni
                                        </label>
                                        <input type="number" min="1" step="1" name="jumlah_koloni" value="{{ old('jumlah_koloni') }}" class="form-control @error('jumlah_koloni') is-invalid @enderror" autocomplete="off">
                                        @error('jumlah_koloni')
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
@endpush

@push('page-spesific-scripts')
<script src="{{ asset('../assets/js/page/modules-datatables.js') }}"></script>
@endpush

@push('after-scripts')
<script>
    $(".input").on('input', function(){
        
        var x = document.getElementById('panjang').value;
        x = parseFloat(x);
        
        var y = document.getElementById('lebar').value;
        y = parseFloat(y);

        if(Number.isNaN(x))
        x=0;
        else if(Number.isNaN(y))
        y=0;
        document.getElementById('rekom').value = (x*y)*8;
    });
</script>
@endpush