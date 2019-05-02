@extends('layouts.default')

@section('title', 'QandA')

@section('content')
    <div class="container">
        <!--
        <div class="question jumbotron">
            <h5><a href="{{ action('UserController@show', $question->user) }}">{{ $question->user->name }}</a> さんの質問</h5>
            <h2 class="mb-3 pb-3 d-flex justify-content-center border border-left-0 border-right-0 border-top-0">{{ $question->title }}</h2>
            @foreach($question->tags as $tag)
                <small class="text-muted text-right d-flex justify-content-end">タグ : <span class="badge badge-success ml-2">{{ $tag->title }}</span></small>
            @endforeach
            <p class="pb-3 border border-left-0 border-right-0 border-top-0">{{ $question->body }}</p>
        </div>
        -->
        @component('components.question-detail', compact('question'))
        @endcomponent
        <div class="answer-form">
            <h2 class="mb-3 pt-3 border border-left-0 border-right-0 border-bottom-0">回答一覧</h2>
            @if (count($answers) > 0)
                <aside>回答数({{ count($answers) }})</aside>
                @foreach($answers as $answer)
                    @component('components.answer-card', compact('answer'))
                    @endcomponent
                @endforeach
            @else
                <p>回答者はいません.</p>
            @endif

            @can('store', [\App\Answer::class, $question])
                <form method="post" action="{{ action('AnswerController@store', $question) }}" class="form-group" id="answer">
                    @csrf
                    <textarea class="form-control mb-3" name="answer">{{ old('answer') }}</textarea>
                    @if ($errors->has('answer'))
                        <p class="text-danger">*{{ $errors->first('answer') }}</p>
                    @endif
                    <p class="text-center">
                        <input class="btn btn-primary w-50" type="submit" value="この質問に回答する">
                    </p>
                </form>
            @endcan
        </div>
    </div>
@endsection

@push('jquery')
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
@endpush
