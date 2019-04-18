@extends('layouts.default')

@section('title', 'QandA')

@section('header')
    <nav class="navbar navbar-expand-sm navbar-light">
        <h2>
            <a class="navbar-brand text-white" href="/home">QandA</a>
        </h2>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="menu" class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/home" class="nav-link">質問一覧</a>
                </li>
                <li class="nav-item">
                    <a href="/home/create" class="nav-link">質問する</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/home/profile">プロフィール</a>
                </li>
            </ul>
        </div>
    </nav>
@endsection

@section('content')
    <div class="container">

        <h2 class="mb-3 pb-3 d-flex justify-content-center border border-left-0 border-right-0 border-top-0">{{ $question->title }}</h2>
        @foreach($question->tags as $tag)
            <small class="text-muted text-right d-flex justify-content-end">カテゴリ : {{ $tag->title }}</small>
        @endforeach
        <p>{{ $question->body }}</p>
        <p class="text-center">
            <a class="btn btn-primary w-50" href="{{ action('AnswerController@create', ['id' => $question->id]) }}">次へ</a>
        </p>
    </div>
@endsection
