@extends('layouts.default')

@section('title', 'QandA')

@section('content')
    <div class="container confirm text-center">
        <h3 class="mb-3">この内容でよろしいですか？</h3>
        <table class="table">
            <tr><th>タイトル</th><td>{{ $request->title }}</td></tr>
            <tr><th>質問内容</th><td>{{ $request->body }}</td></tr>
            <tr><th>タグ</th><td>{{ $request->tag }}</td></tr>
        </table>
        <div class="send text-center">
            <form method="post" action="{{ action('QuestionController@store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="title" value="{{ $request->title }}">
                <input type="hidden" name="body" value="{{ $request->body }}">
                <input type="hidden" name="tag" value="{{ $request->tag }}">
                <input class="btn btn-primary mb-2" type="submit" value="投稿する"><br>
            </form>
            <a href="{{ action('QuestionController@create') }}">修正する</a>
        </div>
    </div>
@endsection




