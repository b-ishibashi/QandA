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
    <div class="search-keywords container pb-3">
        <form method="get" action="{{ action('IndexController@index') }}" class="form-group">
            <div class="input-group col-md-4 w-50 p-0">
                <input class="form-control py-2 border-right-0 border" type="text" id="example-search-input" name="q" placeholder="search" value="{{ $q }}">
                <span class="input-group-append">
                    <button class="btn btn-outline-secondary border-left-0 border" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
            @if(strlen($q) > 0)
                <div class="mt-2"><strong>「{{ $q }}」</strong>の検索結果</div>
            @endif
            @if($tag)
                <div class="mt-2"><span class="badge badge-success">{{ $tag->title }}</span> で絞り込んでいます</div>
                <input type="hidden" name="tag_id" value="{{ $tag->id }}">
            @endif
        </form>
    </div>
    <div class="container">
        @foreach($questions as $question)
            @component('components.question-card', compact('question'))
            @endcomponent
        @endforeach
    </div>
    <div class="container pagination">
        <span class="mx-auto">{{ $questions->links() }}</span>
    </div>
@endsection

@push('jquery')
    <script>
        'use strict';

        $(function() {
            $('.alert').fadeOut(3000);
        });
    </script>
@endpush

