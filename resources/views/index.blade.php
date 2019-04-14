@extends('layouts.default')

@section('title', 'QandA')

@section('content')
    <div class="contents">
        <img class="rounded-circle mx-auto d-block bg-image" src="{{ asset('/img/bg.png') }}">
        <p class="display-4">
            QandA<br>
            <a class="btn btn-primary" href="/add">無料で始める</a>
        </p>
    </div>
@endsection
