<div class="answer-card mb-3 d-flex flex-column px-2 border" style="
    border-radius: 8px;
    @if ($answer->isBest())
        background: #f9d6d5;
    @endif
">
    <div class="d-flex p-2">
        <div class="d-flex flex-column align-items-center flex-shrink-0 p-1" style="flex-basis: 100px">
            <a href="{{ action('UserController@show', $answer->user) }}">
                <img src="{{ asset($answer->user->avatar) }}" width="64" height="64" class="rounded-circle border">
                <div class="question-user-name">{{ $answer->user->name }} さん</div>
            </a>
        </div>
        <div class="flex-grow-1 d-flex flex-column p-1">
            <small class="text-muted text-right">{{ $answer->updated_at }}</small>
            <p class="mb-1">{{ $answer->body }}</p>
        </div>
    </div>
    @can('selectForBest', $answer)
        <form method="post" action="{{ action('AnswerController@selectForBest', [$answer->question, $answer]) }}">
            @csrf
            <button type="submit" class="btn btn-primary w-25">ベストアンサーに選ぶ</button>
        </form>
    @endcan
</div>
