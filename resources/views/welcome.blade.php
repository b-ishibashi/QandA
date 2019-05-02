@extends('layouts.default')

@section('title', 'QandA')

@section('content')
    <section class="welcome mb-5">
        <div class="welcome-inner-wrapper d-flex justify-content-center align-items-center">
            <div class="welcome-content">
                <p class="display-4">
                    QandA<br>
                    <a class="btn btn-primary" href="{{ action('RegisterController@create') }}">無料で始める</a>
                </p>
            </div>
        </div>
    </section>
    @if($unresolvedQuestions->isNotEmpty())
        <h2 class="text-center">回答求む!</h2>
        <section class="welcome-questions d-flex flex-column">
            @foreach($unresolvedQuestions as $question)
                @component('components.question-card', compact('question'))
                @endcomponent
            @endforeach
        </section>
    @endif
@endsection
