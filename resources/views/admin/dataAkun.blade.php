@extends('layouts.master')

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Data Akun</h4>
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
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Kecamatan</th>
                        <th scope="col">Akun</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $no => $user)
                        <tr>
                            <th scope="row">{{ $no+1 }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ implode(', ', $user->kecamatan()->get()->pluck('nama_kecamatan')->toArray())  }}</td>
                            <td>{{ implode(', ', $user->role()->get()->pluck('name')->toArray())  }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
@endsection