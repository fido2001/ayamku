@extends('layouts.master')

@section('content')
    <div class="card">
        <form method="post" action="@if (Request::fullUrl() == 'http://127.0.0.1:8000/peternak/myProfile')
                    {{ route('edit.profile.Peternak', $user) }}
                @elseif (Request::fullUrl() == 'http://127.0.0.1:8000/distributor/myProfile')
                    {{ route('edit.profile.Distributor', $user) }}    
                @endif" class="needs-validation" novalidate="">
            @csrf
            @method('PATCH')
            <div class="card-header">
            <h4>Edit Profil</h4>
            </div>
            <div class="card-body">
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>Username</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="username" value="{{ $user->username }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                <div class="form-group col-md-6 col-12">
                    <label>Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-6 col-12">
                    <label>Nomor HP</label>
                    <input type="tel" class="form-control @error('noHp') is-invalid @enderror" name="noHp" value="{{ $user->noHp }}">
                    @error('noHp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-12">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control summernote-simple @error('alamat') is-invalid @enderror">{{ $user->alamat }}</textarea>
                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>Kecamatan</label>
                        <select name="kecamatan" id="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror">
                            <option disabled selected>Pilih Salah Satu</option>
                            @foreach ($kecamatan as $kcm)
                                <option {{ $kcm->id == $user->kecamatan_id ? 'selected' : '' }} value="{{ $kcm->id }}">{{ $kcm->nama_kecamatan }}</option>
                            @endforeach
                        </select>
                        @error('kecamatan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <a href="@if (Request::segment(1) == 'peternak')
                            {{ route('edit.password.Peternak') }}
                        @elseif (Request::segment(1) == 'distributor')
                            {{ route('edit.password.Distributor') }}    
                        @endif" class="text-danger">Ganti Password</a>
            </div>
            <div class="card-footer text-right">
                <a href="@if (Request::segment(1) == 'peternak')
                            {{ route('profile.Peternak') }}
                        @elseif (Request::segment(1) == 'distributor')
                            {{ route('profile.Distributor') }}    
                        @endif" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection