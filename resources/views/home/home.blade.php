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
        <h1 class="display-4">質問一覧</h1>
    </div>
    @foreach($questions as $question)
        <div class="question">
            <div>{{ $question->id }}</div>
            <div>{{ $question->title }}</div>
            <div>{{ $question->body }}</div>
            @foreach($question->tags as $tag)
                <div>{{ $tag->title }}</div>
            @endforeach
        </div>
    @endforeach
@endsection
