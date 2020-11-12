@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('../assets/modules/summernote/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ asset('../assets/modules/jquery-selectric/selectric.css') }}">
@endsection
@section('content')
<div class="section-body">
    <h2 class="section-title">Edit Artikel</h2>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('artikel.update.admin', $artikel->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" name="title" value="{{ $artikel->title }}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Isi Konten</label>
                            <div class="col-sm-12 col-md-7">
                                <textarea class="summernote-simple" name="body">{{ $artikel->body }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                            <div class="col-sm-12 col-md-7">
                                <div id="image-preview" class="image-preview">
                                    <label for="image-upload" id="image-label">Pilih Gambar</label>
                                    <input type="file" name="thumbnail" id="image-upload" />
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
                            <div class="flex mt-3">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal">
                                    Hapus Artikel Ini
                                </button>
                            </div>
                            
                            @section('modal')
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Anda yakin ingin menghapusnya ?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <div>Judul : {{ $artikel->title }}</div>
                                                <div class="text-secondary">
                                                    <small><div>Dibuat pada : {{ $artikel->created_at->format("d F Y") }}</div></small>
                                                </div>
                                            </div>
                                            <form action="{{ route('artikel.destroy.admin', $artikel->slug) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="d-flex">
                                                    <button class="btn btn-danger mr-3" type="submit">Ya</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endsection
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