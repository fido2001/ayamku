@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('../assets/modules/summernote/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ asset('../assets/modules/jquery-selectric/selectric.css') }}">
@endsection
@section('content')
<div class="section-body">
    <h2 class="section-title">Tambah Artikel</h2>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Isi Konten</label>
                            <div class="col-sm-12 col-md-7">
                                <textarea class="summernote-simple" name="body">{{ old('body') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                            <div class="col-sm-12 col-md-7">
                                <div id="image-preview" class="image-preview">
                                    <label for="image-upload" id="image-label">Pilih Gambar</label>
                                    <input type="file" name="image" id="image-upload" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                                <a href="{{ route('artikel.index') }}" class="btn btn-danger">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page-scripts')
<script src="{{ asset('../assets/modules/summernote/summernote-bs4.js') }}"></script>
<script src="{{ asset('../assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('../assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
@endpush

@push('page-spesific-scripts')
<script src="{{ asset('../assets/js/page/features-post-create.js') }}"></script>
@endpush