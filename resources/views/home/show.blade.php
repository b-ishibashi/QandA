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
        <div class="question jumbotron">
            <small>{{ $question->user->name }} さんの質問</small>
            <h2 class="mb-3 pb-3 d-flex justify-content-center border border-left-0 border-right-0 border-top-0">{{ $question->title }}</h2>
            @foreach($question->tags as $tag)
                <small class="text-muted text-right d-flex justify-content-end">カテゴリ : <span class="badge badge-success ml-2">{{ $tag->title }}</span></small>
            @endforeach
            <p class="pb-3 border border-left-0 border-right-0 border-top-0">{{ $question->body }}</p>
        </div>
        <div class="answer-form">
            <h2 class="mb-3 pt-3 border border-left-0 border-right-0 border-bottom-0">回答一覧</h2>
            <aside>現在の回答数({{ count($answers) }})</aside>
            @forelse($answers as $answer)
                <div class="answer-form card border-light mb-3" style="max-width: 18rem;">
                    <div class="user-name card-header">{{ $answer->user->name }} さんの回答</div>
                    <div class="answer card-body">
                        <p class="card-text">{{ $answer->body }}</p>
                    </div>
                </div>
            @empty
                <p>回答者はいません.</p>
            @endforelse
            <form method="post" action="{{ action('AnswerController@store', ['id' => $question->id]) }}" class="form-group" id="answer">
                @csrf
                <textarea class="form-control mb-3" name="answer">{{ old('answer') }}</textarea>
                @if ($errors->has('answer'))
                    <p class="text-danger">*{{ $errors->first('answer') }}</p>
                @endif
                <p class="text-center">
                    <input class="btn btn-primary w-50" type="submit" value="この質問に回答する">
                </p>
            </form>
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $('#answer').submit(function(){
            if (confirm('この内容で送信してよろしいですか？'))
            {
                $(this).val('submit');
            } else {
                return false;
            }
        })
    </script>
@endsection
