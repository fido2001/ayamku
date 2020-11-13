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
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" required="">
                        <div class="invalid-feedback">
                            Data tidak boleh kosong, harap diisi!
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" value="{{ $user->username }}" required="">
                        <div class="invalid-feedback">
                            Data tidak boleh kosong, harap diisi!
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="form-group col-md-6 col-12">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" required="">
                    <div class="invalid-feedback">
                        Data tidak boleh kosong, harap diisi!
                    </div>
                </div>
                <div class="form-group col-md-6 col-12">
                    <label>Nomor HP</label>
                    <input type="tel" class="form-control" name="noHp" value="{{ $user->noHp }}">
                    <div class="invalid-feedback">
                        Data tidak boleh kosong, harap diisi!
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-12">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control summernote-simple">{{ $user->alamat }}</textarea>
                        <div class="invalid-feedback">
                            Data tidak boleh kosong, harap diisi!
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>Kecamatan</label>
                        <select name="kecamatan" id="kecamatan" class="form-control">
                            <option disabled selected>Pilih Salah Satu</option>
                            @foreach ($kecamatan as $kcm)
                                <option {{ $kcm->id == $user->kcm_id ? 'selected' : '' }} value="{{ $kcm->id }}">{{ $kcm->nama_kecamatan }}</option>
                            @endforeach
                        </select>
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