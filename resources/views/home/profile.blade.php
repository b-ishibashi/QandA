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
        <div class="container">
            <section class="user-icon d-flex justify-content-center">
                <img src="{{ asset('storage/userimage/' . $user->image) }}" class="rounded-circle">
            </section>
            <small class="d-flex justify-content-end mb-1"><a href="{{ action('UserController@edit', ['id' => $user->id]) }}">プロフィールを編集する</a></small>
            <section class="profile-block">
                <table class="table table-bordered">
                    <tr><th>名前: </th><td>{{ $user->name }}</td></tr>
                    <tr><th>メールアドレス: </th><td>{{ $user->email }}</td></tr>
                </table>
            </section>
            <section class="logout-btn text-center">
                <a class="btn btn-secondary" href="/home/profile/logout">ログアウト</a>
            </section>
        </div>
    </div>
@endsection
