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
    <div id="wrapper">
        <section class="container user-profile mb-3">
            <div class="user-icon text-center">
                <img src="{{ asset('storage/userimage/' . $user->image) }}" class="rounded-circle">
            </div>
            <small class="d-flex justify-content-end mb-1"><a href="{{ action('UserController@edit', ['id' => $user->id]) }}">プロフィールを編集する</a></small>
            <div class="profile-block">
                <table class="table table-bordered">
                    <tr><th>名前: </th><td>{{ $user->name }}</td></tr>
                    <tr><th>メールアドレス: </th><td>{{ $user->email }}</td></tr>
                </table>
            </div>
            <div class="logout-btn text-center">
                <a class="btn btn-secondary" href="/home/profile/logout">ログアウト</a>
            </div>
        </section>
        <section class="container user-question">
            <h2>{{ $user->name }} さんの質問一覧</h2>
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
        </section>
    </div>
@endsection
