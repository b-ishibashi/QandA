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
    <div class="container confirm text-center">
        <h3 class="mb-3">この内容でよろしいですか？</h3>
        <table class="table">
            <tr><th>タイトル</th><td>{{ $request->title }}</td></tr>
            <tr><th>質問内容</th><td>{{ $request->body }}</td></tr>
            <tr><th>カテゴリー</th><td>{{ $request->category }}</td></tr>
        </table>
        <div class="send text-center">
            <form method="post" action="/home/confirm">
                @csrf
                <input type="hidden" name="title" value="{{ $request->title }}">
                <input type="hidden" name="body" value="{{ $request->body }}">
                <input type="hidden" name="category" value="{{ $request->category }}">
                <input class="btn btn-primary mb-2" type="submit" value="投稿する"><br>
            </form>
            <a href="/home/create">修正する</a>
        </div>
    </div>
@endsection




