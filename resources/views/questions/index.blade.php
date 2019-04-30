@extends('layouts.default')

@section('title', 'QandA')

@section('content')

    @if (session('login'))
        @component('components.message')
            {{ session('login') }}
        @endcomponent
    @endif

    <div class="container">
        <h1 class="display-4 text-center mb-3">質問一覧</h1>
    </div>
    <div class="container pagination mb-3">
        <span class="mx-auto">{{ $questions->links() }}</span>
    </div>
    <div class="search-keywords container ">
        <form method="post" action="{{ action('QuestionController@search') }}" class="form-group">
            @csrf
            <div class="input-group col-md-4 w-50">
                <input class="form-control py-2 border-right-0 border" type="search" id="example-search-input" name="search" placeholder="search">
                <span class="input-group-append">
                <button class="btn btn-outline-secondary border-left-0 border" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </span>
            </div>
        </form>
    </div>
    <div class="container">
        @foreach($questions as $question)
            <div class="question-block list-group mb-3">
                <a href="{{ action('QuestionController@show', $question) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <small>{{ $question->user->name }} さん</small>
                        <small class="text-muted">{{ $question->updated_at }}</small>
                    </div>
                    <h4 class="mb-1">{{ $question->title }}</h4>
                    <p class="mb-1 question_body">{{ $question->body }}</p>
                    @foreach($question->tags as $tag)
                        <small class="text-muted">タグ : <span class="badge badge-success ml-1">{{ $tag->title }}</span></small>
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

