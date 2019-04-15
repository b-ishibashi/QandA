@extends('layouts.default')

@section('title', 'QandA')

@section('header')
    <nav class="navbar navbar-expand-sm navbar-light">
        <h2>
            <a class="navbar-brand text-white" href="/">QandA</a>
        </h2>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="menu" class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/add" class="nav-link">アカウント登録</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login">ログイン</a>
                </li>
            </ul>
        </div>
    </nav>
@endsection

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-3">ログイン</h1>
        @if (count($errors) > 0)
            <p class="alert alert-danger text-center">入力に問題があります。再入力してください。</p>
        @endif
        <form method="post" action="/login">
            @csrf
            <div class="form-group">
                <label for="user_email">メールアドレス</label>
                <br>
                <input class="form-control" type="email" name="email" id="user_email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <p class="text-danger">*{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="user_password">パスワード</label>
                <br>
                <input class="form-control" type="password" name="password" id="user_password">
                @if ($errors->has('password'))
                    <p class="text-danger">*{{ $errors->first('password') }}</p>
                @endif
            </div>
            <div class="form-group text-center">
                <input type="submit" value="ログイン" class="btn btn-primary w-50">
            </div>
            <p class="text-center"><a href="/add">アカウント登録</a></p>
        </form>
    </div>
@endsection
