@extends('layouts.default')

@section('title', 'QandA')

@section('header')
    <ul class="nav navbar">
        <li class="nav-item">
            <a class="nav-link active text-white h3" href="/">QandA</a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="contents">
        <img class="rounded-circle mx-auto d-block bg-image" src="{{ asset('/img/bg.png') }}">
        <p class="display-4">
            QandA<br>
            <a class="btn btn-primary" href="/add">無料で始める</a>
        </p>
    </div>
@endsection
