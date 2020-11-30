@extends('layouts.master')

@section('content')

<div class="section-body">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="section-title">Artikel</h2>
        @if (Request::segment(1) == 'admin')
            <a href="{{ route('artikel.create') }}" class="btn btn-success">Tambah Artikel</a>
        @endif
    </div>
    @if (session()->has('success'))
        <div class="col-md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    <div class="row">
        @forelse ($artikel as $art)
            <div class="col-12 col-md-4 col-lg-4">
                <article class="article article-style-c">
                    @if ($art->thumbnail)
                    <a href="@if(Request::segment(1) == 'admin') {{ route('artikel.edit.admin', $art->slug) }}
                            @elseif(Request::segment(1) == 'distributor') {{ route('artikel.show.distributor', $art->slug) }}  
                            @endif">
                        <div class="article-header">
                            <div class="article-image" data-background="{{ $art->takeImage() }}">
                            </div>
                        </div>
                    </a>
                    @endif
                    <div class="article-details">
                        <div class="article-category"><a>Dibuat {{ $art->created_at->diffForHumans() }}</a></div>
                        <div class="article-title">
                        <h2><a href="@if(Request::segment(1) == 'admin') {{ route('artikel.edit.admin', $art->slug) }}
                            @elseif(Request::segment(1) == 'distributor') {{ route('artikel.show.distributor', $art->slug) }}  
                            @endif">{{ $art->title }}</a></h2>
                        </div>
                        <p>{!! Str::limit(nl2br($art->body), 100) !!}</p>
                        <div class="article-user align-items-center">
                            <div class="media align-items-center">
                                <img width="40" class="rounded-circle mr-3" src="{{ asset('../assets/img/avatar/avatar-1.png') }}" alt="">
                                <div class="media-body">
                                    <div>
                                        {{ $art->author->name }}
                                    </div>
                                </div>
                            </div>
                            @if(Request::segment(1) == 'admin')
                            <a href="{{ route('artikel.edit.admin', $art->slug) }}" class="btn btn-warning float-right">Ubah Artikel</a>
                            @endif
                        </div>
                    </div>
                </article>
            </div>
            @empty
            <div class="col-md-6">
                <div class="alert alert-info">
                    Belum ada artikel.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection