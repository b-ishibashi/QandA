@extends('layouts.default')

@section('title', 'QandA')

@section('content')

    @if (session('update'))
        @component('components.message')
            {{ session('update') }}
        @endcomponent
    @endif

    <div class="container">
        <div class="row d-flex justify-content-center">
            <section class="user-profile mb-3 mr-5">
                <div class="text-center">
                    <img src="{{ asset($user->avatar) }}" class="rounded-circle border" width="180" height="180">
                </div>
                @can('update', $user)
                <small class="d-flex justify-content-end mb-1"><a href="{{ action('UserController@edit', $user) }}">プロフィールを編集する</a></small>
                @endcan
                <div class="profile-block p-1">
                    <table class="table">
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
            <section class="user-questions flex-grow-1">
                <h2>{{ $user->name }} さんの質問一覧</h2>
                @foreach($questions as $question)
                    @component('components.question-card', compact('question'))
                    @endcomponent
                @endforeach
            </section>
        </div>
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
