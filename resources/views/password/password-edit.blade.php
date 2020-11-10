@extends('layouts.master')

@section('title', 'Ganti Password | Ayam-Ku')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif
                    <form action="@if (Request::segment(1) == 'admin')
                                    {{ route('edit.password.Admin') }}
                                @elseif (Request::segment(1) == 'peternak')
                                    {{ route('edit.password.Peternak') }}
                                @elseif (Request::segment(1) == 'distributor')
                                    {{ route('edit.password.Distributor') }}    
                                @endif" method="POST">
                        @csrf
                        @method("PATCH")
                        <div class="form-group">
                            <label for="old-password">Password Saat Ini</label>
                            <input type="password" name="old_password" id="old-password" class="form-control @error('old_password') is-invalid @enderror">
                            @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection