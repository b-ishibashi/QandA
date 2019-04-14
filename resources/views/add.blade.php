@extends('layouts.default')

@section('title', 'QandA')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-3">アカウント登録</h1>
        @if (count($errors) > 0)
            <p class="alert alert-danger text-center">入力に問題があります。再入力してください。</p>
        @endif
        <form method="post" action="/add">
            @csrf
            <div class="form-group">
                <label for="user_name">名前</label>
                <br>
                <input class="form-control" type="text" name="name" id="user_name" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <p class="text-danger">*{{ $errors->first('name') }}</p>
                @endif
            </div>
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
            <div class="form-group">
                <label for="user_password_confirmation">パスワード(確認用)</label>
                <br>
                <input class="form-control" type="password" name="password_confirmation" id="user_password_confirmation">
                @if ($errors->has('password_confirmation'))
                    <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                @endif
            </div>
            <div class="form-group text-center">
                <input type="submit" value="登録" class="btn btn-primary w-50">
            </div>
        </form>
        <p class="text-center"><a href="/login">ログイン</a></p>
    </div>
@endsection
