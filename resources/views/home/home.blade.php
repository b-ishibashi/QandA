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
    @if (session('success'))
        <div class="alert alert-success w-50" role="alert">
            <strong>✓ ログインしました</strong>
        </div>
    @endif
    <div class="container">
        <h1 class="display-4 text-center mb-3">質問一覧</h1>
    </div>
    <div class="container pagination mb-3">
        <span class="mx-auto">{{ $questions->links() }}</span>
    </div>
    <div class="container">
        @foreach($questions as $question)
            <div class="question-block list-group mb-3">
                <a href="{{ action('QuestionController@show', ['id' => $question->id]) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <small>{{ $question->user->name }} さん</small>
                        <small class="text-muted">{{ $question->updated_at }}</small>
                    </div>
                    <h4 class="mb-1">{{ $question->title }}</h4>
                    <p class="mb-1 question_body">{{ $question->body }}</p>
                    @foreach($question->tags as $tag)
                        <small class="text-muted">カテゴリ : <span class="badge badge-success ml-1">{{ $tag->title }}</span></small>
                    @endforeach
                </a>
            </div>
        @endforeach
    </div>
    <div class="container pagination">
        <span class="mx-auto">{{ $questions->links() }}</span>
    </div>
@endsection

@section('jquery')
    <script>
        'use strict';

        $(function() {
            $('.alert').fadeOut(3000);
        });
    </script>
@endsection

