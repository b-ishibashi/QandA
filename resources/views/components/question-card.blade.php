<div class="question-card mb-3 d-flex flex-column px-2 border" style="
    border-radius: 8px;
    @if($question->bestAnswer)
        background: #fffbdb;
    @endif
">
    <div class="d-flex p-2">
        <div class="d-flex flex-column align-items-center flex-shrink-0 p-1" style="flex-basis: 100px">
            <a href="{{ action('UserController@show', $question->user) }}">
                <img src="{{ asset($question->user->avatar) }}" width="64" height="64" class="rounded-circle border">
                <div class="question-user-name">{{ $question->user->name }} さん</div>
            </a>
        </div>
        <div class="flex-grow-1 d-flex flex-column p-1">
            <small class="text-muted text-right">{{ $question->updated_at }}</small>
            <h5 class="mb-1"><a href="{{ action('QuestionController@show', $question) }}">{{ $question->title }}</a></h5>
            <p class="mb-1 question_body ellipsis">{{ $question->body }}</p>
        </div>
    </div>
    <div class="text-muted p-2" style="font-size: small; line-height: 1">
        タグ：
        @foreach($question->tags as $tag)
            <a href="{{ action('IndexController@index') . '?' . http_build_query(['tag_id' => $tag->id], '', '&') }}">
                <span class="badge badge-success" style="vertical-align: bottom" id="tag_id">{{ $tag->title }}</span>
            </a>
        @endforeach
    </div>
</div>




