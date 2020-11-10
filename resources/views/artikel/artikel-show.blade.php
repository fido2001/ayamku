@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if ($artikel->thumbnail)
                    <img style="height: 550px; object-fit: cover; object-position: center" class="rounded" src="{{ $artikel->takeImage() }}">
                @endif
                <h1>{{ $artikel->title }}</h1>
                <div class="media my-3">
                    <img width="60" class="rounded-circle mr-3" src="{{ asset('../assets/img/avatar/avatar-1.png') }}" alt="">
                    <div class="media-body text-muted">
                        <div>
                            {{ $artikel->author->name }}
                        </div>
                        {{ '@' . $artikel->author->username }}
                    </div>
                </div>
                <hr>
                <p>{!! nl2br($artikel->body) !!}</p>
            </div>
        </div>
    </div>
@endsection