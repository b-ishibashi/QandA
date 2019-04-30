@extends('layouts.default')

@section('title', 'QandA')

@section('content')

    @if (session('update'))
        @component('components.message')
            {{ session('update') }}
        @endcomponent
    @endif

    <div id="wrapper">
        <div class="container">
            <div class="row">
                <section class="user-profile mb-3 mr-5">
                    <div class="user-icon text-center">
                        <img src="{{ asset($user->avatar) }}" class="rounded-circle">
                    </div>
                    <small class="d-flex justify-content-end mb-1"><a href="{{ action('UserController@edit', $user) }}">プロフィールを編集する</a></small>
                    <div class="profile-block">
                        <table class="table table-bordered">
                            <tr><th>名前: </th><td>{{ $user->name }}</td></tr>
                            @can('showEmail', $user)
                                <tr><th>メールアドレス: </th><td>{{ $user->email }}</td></tr>
                            @endcan
                        </table>
                    </div>
                    @can('showLogoutButton', $user)
                    <div class="logout-btn text-center">
                        <form method="post" action="{{ action('SessionController@logout') }}">
                            @csrf
                            <button class="btn btn-secondary" type="submit" href="{{ action('SessionController@logout') }}">ログアウト</button>
                        </form>
                    </div>
                    @endcan
                </section>
                <section class="user-questions">
                    <h2>{{ $user->name }} さんの質問一覧</h2>
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
                                    <small class="text-muted">カテゴリ : <span class="badge badge-success ml-1">{{ $tag->title }}</span></small>
                                @endforeach
                            </a>
                        </div>
                    @endforeach
                </section>
            </div>
        </div>
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
