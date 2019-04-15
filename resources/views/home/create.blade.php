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
<form method="post" action="/home/create" class="form-group">
    @csrf
    <div class="container post-form">
        <div class="title-form row">
            <label for="title" class="col-sm-3">タイトル</label>
            <input class="form-control col-sm-9" type="text" name="title" id="title" value="{{ old('title') }}">
            @if ($errors->has('title'))
                <label class="col-sm-3"></label><p class="col-sm-9 text-danger">*{{ $errors->first('title') }}</p>
            @else
                <label class="col-sm-3"></label><p class="col-sm-9"></p>
            @endif
        </div>
        <div class="body-form row">
            <label for="body" class="col-sm-3">質問内容</label>
            <textarea class="form-control col-sm-9" maxlength="2000" name="body" id="body">{{ old('body') }}</textarea>
            @if ($errors->has('title'))
                <label class="col-sm-3"></label><p class="col-sm-7 text-danger">*{{ $errors->first('body') }}</p>
            @else
                <label class="col-sm-3"></label><p class="col-sm-7"></p>
            @endif
        </div>
        <div class="category mb-4 row">
            <label for="category" class="col-sm-3">カテゴリー選択</label>
            <select class="form-control col-sm-5" id="category" name="category">
                @foreach($categories as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>
        </div>
        <div class="file mb-4 row">
            <label for="file" class="col-sm-3">画像を添付</label>
            <input class="form-control-file col-sm-6" type="file" id="file">
        </div>
        <div class="send text-center">
            <input class="btn btn-primary" type="submit" value="次へ">
        </div>
    </div>
</form>
@endsection



