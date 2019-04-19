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
            <h1 class="text-center mb-3">プロフィールの編集</h1>
            <section class="profile-block">
                <table class="table table-borderless">
                    <form method="post" action="{{ action('UserController@update', ['id' => $user->id]) }}" class="form-group" enctype="multipart/form-data">
                        @csrf
                        <tr><th>ユーザーアイコン: </th><td><input type="file" name="user_image"></td></tr>
                        @if($errors->has('user_image'))
                            <tr><th></th><td><small class="text-danger">*{{ $errors->first('user_image') }}</small></td></tr>
                        @endif
                        <tr><th>名前: </th><td><input class="form-control" type="text" name="name" value="{{ old('name') ?? $user->name }}"></td></tr>
                        @if($errors->has('name'))
                            <tr><th></th><td><small class="text-danger">*{{ $errors->first('name') }}</small></td></tr>
                        @endif
                        <tr><th>メールアドレス: </th><td><input class="form-control" type="email" name="email" value="{{ old('email') ?? $user->email }}"></td></tr>
                        @if($errors->has('email'))
                            <tr><th></th><td><small class="text-danger">*{{ $errors->first('email') }}</small></td></tr>
                        @endif
                        <tr><th></th><td><input class="btn btn-primary" type="submit" value="更新する"></td></tr>
                    </form>
                </table>
            </section>
        </div>
    </div>
@endsection
